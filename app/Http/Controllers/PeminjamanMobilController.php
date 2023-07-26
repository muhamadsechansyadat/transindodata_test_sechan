<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Manajemen;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class PeminjamanMobilController extends Controller
{
    public function index(){
        $data = Peminjaman::where('users_id', Auth::user()->id)->where('active', true)->orderBy('created_at', 'desc')->get();
        return view('dashboard.peminjaman.index', ['data' => $data]);
    }

    public function create(){
        $mobil = Manajemen::whereNull('deleted_at')->whereNot('users_id', Auth::user()->id)->get();
        return view('dashboard.peminjaman.create', ['mobil' => $mobil]);
    }

    public function store(Request $request){
        $rules = [
            'mobil' => 'required|exists:manajemen,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|after:tanggal_mulai',
        ];
        $validated = $request->validate($rules);
        $startDate = Carbon::createFromFormat('Y-m-d', $request->tanggal_mulai);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->tanggal_selesai);
        $already_sewa = Peminjaman::where('mobil_id', $request->mobil)->where('active', true)->whereDate('tanggal_selesai', '>', $startDate)->get();
        if (count($already_sewa) != 0){
            return back()->with('error', 'Maaf mobil sudah ada yang sewa')->withInput();
        }
        $data = [
            'mobil_id' => $request->mobil,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'users_id' => Auth::user()->id,
            'active' => true,
        ];
        
        try {
            DB::beginTransaction();
            $update = Peminjaman::create($data);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('peminjaman-mobil.index')->with('success', 'Sukses Merubah Data');
    }

    public function edit($id){
        $data = Peminjaman::where('id', $id)->where('users_id', Auth::user()->id)->first();
        $mobil = Manajemen::whereNull('deleted_at')->whereNot('users_id', Auth::user()->id)->get();
        return view('dashboard.peminjaman.edit', ['data' => $data, 'mobil' => $mobil]);
    }

    public function update(Request $request, $id){
        $rules = [
            'mobil' => 'required|exists:manajemen,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ];
        $validated = $request->validate($rules);
        $already_sewa = Peminjaman::where('mobil_id', $request->mobil)->whereDate('tanggal_mulai', '>=', $request->tanggal_mulai)
        ->whereDate('tanggal_selesai', '<=', $request->tanggal_selesai)
        ->whereNot('id', $id)
        ->get();
        if (count($already_sewa) != 0){
            return back()->with('error', 'Maaf mobil sudah ada yang sewa')->withInput();
        }
        $data = [
            'mobil_id' => $request->mobil,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'users_id' => Auth::user()->id,
        ];
        
        try {
            DB::beginTransaction();
            $update = Peminjaman::where('id', $id)->where('users_id', Auth::user()->id)->update($data);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('peminjaman-mobil.index')->with('success', 'Sukses Merubah Data');
    }

    public function delete($id) {
        try {
            $data = Peminjaman::where('id', $id)->where('users_id', Auth::user()->id)->first();
            $data->delete();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('peminjaman-mobil.index')->with('success', 'Sukses Menghapus Data');
    }
}

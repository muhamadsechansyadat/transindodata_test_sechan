<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class PengembalianMobilController extends Controller
{
    public function index(){
        $data = Pengembalian::where('users_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.pengembalian.index', ['data' => $data]);
    }

    public function create(){
        return view('dashboard.pengembalian.create');
    }

    public function store(Request $request){
        $getPinjaman = Peminjaman::where('users_id', Auth::user()->id)->whereHas('mobil', function($query) use($request){
            return $query->where('nomor_plat', '=', $request->nomor_plat);
        })->orderBy('tanggal_selesai', 'asc')->first();
        if(empty($getPinjaman)){
            return back()->with('error', 'Nomor plat tidak valid')->withInput();
        }

        $data = [
            'users_id' => Auth::user()->id,
            'mobil_id' => $getPinjaman->mobil->id,
            'tanggal_pengembalian' => Carbon::now(),
            'active' => true,
            'peminjaman_id' => $getPinjaman->id,
        ];

        try {
            DB::beginTransaction();
            $update = Pengembalian::create($data);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('pengembalian-mobil.index')->with('success', 'Sukses mengembalikan mobil');
    }
}

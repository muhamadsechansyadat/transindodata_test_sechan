<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Manajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManajemenMobilController extends Controller
{
    public function index(){
        $data = Manajemen::where('users_id', Auth::user()->id)->whereNull('deleted_at')->orderBy('created_at', 'desc')->get();
        return view('dashboard.manajemen.index', ['data' => $data]);
    }

    public function create(){
        return view('dashboard.manajemen.create');
    }

    public function store(Request $request){
        $rules = [
            'merek' => 'required|max:225',
            'model' => 'required|max:225',
            'nomor_plat' => 'required|max:10|unique:manajemen',
            'tarif' => 'required',
        ];
        $validated = $request->validate($rules);
        $tarif = substr($request->tarif, 4);
        $tarif = str_replace('.', '', $tarif);

        $data = [
            'merek' => $request->merek,
            'model' => $request->model,
            'nomor_plat' => $request->nomor_plat,
            'tarif' => $tarif,
            'users_id' => Auth::user()->id,
        ];

        try {
            DB::beginTransaction();
            $save = Manajemen::create($data);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('manajemen-mobil.index')->with('success', 'Sukses Menambahkan Data');
    }

    public function edit($id){
        $data = Manajemen::where('id', $id)->where('users_id', Auth::user()->id)->first();
        return view('dashboard.manajemen.edit', ['data' => $data]);
    }

    public function update(Request $request, $id){
        $rules = [
            'merek' => 'required|max:225',
            'model' => 'required|max:225',
            'nomor_plat' => 'required|max:10|unique:manajemen',
            'tarif' => 'required',
        ];
        $validated = $request->validate($rules);
        $tarif = substr($request->tarif, 4);
        $tarif = str_replace('.', '', $tarif);

        $data = [
            'merek' => $request->merek,
            'model' => $request->model,
            'nomor_plat' => $request->nomor_plat,
            'tarif' => $tarif,
            'users_id' => Auth::user()->id,
        ];

        try {
            DB::beginTransaction();
            $update = Manajemen::where('id', $id)->where('users_id', Auth::user()->id)->update($data);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('manajemen-mobil.index')->with('success', 'Sukses Merubah Data');
    }

    public function delete($id) {
        try {
            $data = Manajemen::where('id', $id)->where('users_id', Auth::user()->id)->first();
            $data->update([
                'deleted_at' => Carbon::now(),
            ]);
        } catch (QueryException $ex) {
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('manajemen-mobil.index')->with('success', 'Sukses Menghapus Data');
    }
}

<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginPost(Request $request){
        $rules = [
            'no_telp' => [
                'required',
                'min:10',
                'max:18',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
            ],
            'password' => 'required',
        ];
        $validated = $request->validate($rules);
        $no_telp = (substr($request->no_telp,0,3) == '+62' ? "62".substr($request->no_telp, 3) : (substr($request->no_telp,0,2) == '08' ? "62".substr($request->no_telp, 1) : (substr($request->no_telp,0,1) == '8' ? "62".substr($request->no_telp, 0) : $request->no_telp)));
        $user = User::select('password')->where('no_telp', $no_telp)->first();
        if($user == null){
            return back()->with('error', 'No Telepon anda tidak valid')->withInput();
        }
        if(!Hash::check($request->password, $user->password)){
            return back()->with('error', 'Password anda tidak valid')->withInput();
        }
        $userLogin = [
            'no_telp' => $no_telp,
            'password' => $request->password,
        ];
        $att = Auth::attempt($userLogin);
        if ($att) {
            return redirect()->route('manajemen-mobil.index')->with('success', 'sukses login');
        }else{
            return back()->with('error', 'gagal login');
		}
    }

    public function register(){
        return view('auth.register');
    }

    public function registerPost(Request $request){
        $rules = [
            'nama' => 'required|max:225',
            'no_telepon' => [
                'required',
                'min:10',
                'max:18',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
            ],
            'alamat' => 'required',
            'no_sim' => 'required|max:50',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:8|required_with:password|same:password',
        ];
        $validated = $request->validate($rules);
        $no_telepon = (substr($request->no_telepon,0,3) == '+62' ? "62".substr($request->no_telepon, 3) : (substr($request->no_telepon,0,2) == '08' ? "62".substr($request->no_telepon, 1) : (substr($request->no_telepon,0,1) == '8' ? "62".substr($request->no_telepon, 0) : $request->no_telepon)));

        $data = [
            'nama' => $request->nama,
            'no_telp' => $no_telepon,
            'alamat' => $request->alamat,
            'no_sim' => $request->no_sim,
            'password' => Hash::make($request->password)
        ];

        try {
            DB::beginTransaction();
            $regis = User::create($data);
            DB::commit();
        } catch (QueryException $ex) {
            DB::rollback();
            return back()->with('error', $ex->getMessage())->withInput();
        }
        return redirect()->route('login')->with('success', 'Register success');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}

@extends('auth.base')
@section('title')
    Register
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/jquery-selectric/selectric.css') }}">
@endsection

@section('content')
    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
        <div class="login-brand">
            <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Register</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="nama">Nama</label>
                            <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama', '') }}" autofocus>
                            @error('nama')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="no_telepon">No Telepon</label>
                            <input id="no_telepon" type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon', '') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            @error('no_telepon')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no_sim">No SIM</label>
                        <input id="no_sim" type="text" class="form-control" name="no_sim" value="{{ old('no_sim', '') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        @error('no_sim')
                        <div class="invalid-feedback" style="display: unset !important;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10">{{ old('alamat', '') }}</textarea>
                        @error('alamat')
                        <div class="invalid-feedback" style="display: unset !important;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="form-group col-6">
                            <label for="password" class="d-block">Password</label>
                            <input id="password" type="password" class="form-control pwstrength"
                                data-indicator="pwindicator" name="password">
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                            @error('password')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label for="password2" class="d-block">Password Confirmation</label>
                            <input id="password2" type="password" class="form-control" name="confirm_password">
                            @error('confirm_password')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5 text-muted text-center">
            Already have account? <a href="{{ route('login') }}">Sign in</a>
        </div>
        <div class="simple-footer">
            Copyright &copy; Stisla 2018
        </div>
    </div>
@endsection
@section('js')
    <!-- JS Libraies -->
    <script src="{{ asset('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/auth-register.js') }}"></script>
@endsection

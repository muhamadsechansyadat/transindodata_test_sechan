@extends('auth.base')
@section('title')
    Login
@endsection

@section('content')
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="login-brand">
            <img src="assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Login</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate="">
                    @csrf
                    <div class="form-group">
                        <label for="no_telepon">No Telepon</label>
                        <input id="no_telepon" type="text" class="form-control" name="no_telp" value="{{ old('no_telp', '') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                        @error('no_telp')
                        <div class="invalid-feedback" style="display: unset !important;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        </div>
                        <input id="password" type="password" class="form-control" name="password">
                        @error('password')
                        <div class="invalid-feedback" style="display: unset !important;">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Login
                        </button>
                    </div>
                </form> 
            </div>
        </div>
        <div class="mt-5 text-muted text-center">
            Don't have an account? <a href="{{ route('register') }}">Create One</a>
        </div>
        <div class="simple-footer">
            Copyright &copy; Stisla 2018
        </div>
    </div>
@endsection

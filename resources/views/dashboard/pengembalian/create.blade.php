@extends('layouts.base')
@section('title-content')
    Pengembalian Mobil - Create
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pengembalian-mobil.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nomor_plat">Nomor Plat</label>
                            <input type="text" name="nomor_plat" id="nomor_plat" class="form-control" value="{{ old('nomor_plat', '') }}">
                            @error('nomor_plat')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="submit" value="Kembalikan" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

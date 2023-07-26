@extends('layouts.base')
@section('title-content')
    Peminjaman - Edit
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('peminjaman-mobil.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="mobil">Mobil</label>
                            <select name="mobil" id="mobil" class="form-control">
                                <option value="">Pilih Mobil</option>
                                @foreach ($mobil as $item)
                                    <option value="{{ $item->id }}" @if(old('mobil') == $item->id) selected @endif @if($data->mobil_id == $item->id) selected @endif>{{ $item->model . ' - ' . "Rp " . number_format($item->tarif,2,',','.') . '(perhari)' }}</option>
                                @endforeach
                            </select>
                            @error('mobil')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', date_format(date_create($data->tanggal_mulai), "Y-m-d")) }}">
                            @error('tanggal_mulai')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', date_format(date_create($data->tanggal_selesai), "Y-m-d")) }}">
                            @error('tanggal_selesai')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <input type="submit" value="Save" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.base')
@section('title-content')
    Peminjaman - Create
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('peminjaman-mobil.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="mobil">Mobil</label>
                            <select name="mobil" id="mobil" class="form-control">
                                <option value="">Pilih Mobil</option>
                                @foreach ($mobil as $item)
                                    <option value="{{ $item->id }}" @if(old('mobil') == $item->id) selected @endif>{{ $item->model . ' - ' . "Rp " . number_format($item->tarif,2,',','.') . '(perhari)' }}</option>
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
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', '') }}">
                            @error('tanggal_mulai')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', '') }}">
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
@section('js')
    <script type="text/javascript">
        /* Dengan Rupiah */
        var dengan_rupiah = document.getElementById('tarif');
        dengan_rupiah.addEventListener('keyup', function(e) {
            dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
        });

        /* Fungsi */
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>
@endsection

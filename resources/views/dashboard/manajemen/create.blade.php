@extends('layouts.base')
@section('title-content')
    Manajemen - Create
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('manajemen-mobil.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input type="text" name="merek" id="merek" class="form-control" value="{{ old('merek', '') }}">
                            @error('merek')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="model">Model</label>
                            <input type="text" name="model" id="model" class="form-control" value="{{ old('model', '') }}">
                            @error('model')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomor_plat">Nomor Plat</label>
                            <input type="text" name="nomor_plat" id="nomor_plat" class="form-control" value="{{ old('nomor_plat', '') }}">
                            @error('nomor_plat')
                            <div class="invalid-feedback" style="display: unset !important;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tarif">Tarif(Per-Hari)</label>
                            <input type="text" name="tarif" id="tarif" class="form-control" value="{{ old('tarif', '') }}">
                            @error('tarif')
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

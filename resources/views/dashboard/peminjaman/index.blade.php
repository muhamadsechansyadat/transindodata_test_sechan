@extends('layouts.base')
@section('title-content')
    Peminjaman
@endsection
@section('content')
    <h2 class="section-title">Peminjaman Mobil</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Peminjaman Mobil</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('peminjaman-mobil.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Create</a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Model</th>
                                    <th>Nomor Plat</th>
                                    <th>Tarif(per-Hari)</th>
                                    <th>Pemilik</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->mobil->model ?? '' }}</td>
                                        <td>{{ $row->mobil->nomor_plat ?? '' }}</td>
                                        <td>{{ "Rp " . number_format($row->mobil->tarif,2,',','.') }}</td>
                                        <td>{{ $row->mobil->users->nama ?? '' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->tanggal_mulai)->format('d M Y')}}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->tanggal_selesai)->format('d M Y')}}</td>
                                        <td>
                                            <a href="{{ route('peminjaman-mobil.edit', $row->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#table-1").dataTable();
    </script>
@endsection

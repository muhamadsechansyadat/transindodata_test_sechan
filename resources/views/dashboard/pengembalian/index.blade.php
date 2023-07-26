@extends('layouts.base')
@section('title-content')
    Pengembalian
@endsection
@section('content')
    <h2 class="section-title">Pengembalian Mobil</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Pengembalian Mobil</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('pengembalian-mobil.create') }}" class="btn btn-primary mb-3"><i class="fa fa-exit"></i> Kembalikan</a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Model</th>
                                    <th>Nomor Plat</th>
                                    <th>Total</th>
                                    <th>Pemilik</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    @php
                                        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row->peminjaman->tanggal_mulai);
                                        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $row->peminjaman->tanggal_selesai);
                                        $diff_in_days = $to->diffInDays($from);
                                    @endphp 
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->peminjaman->mobil->model ?? '' }}</td>
                                        <td>{{ $row->peminjaman->mobil->nomor_plat ?? '' }}</td>
                                        <td>{{"Rp " . number_format(($diff_in_days * $row->peminjaman->mobil->tarif),2,',','.')}}</td>
                                        <td>{{ $row->peminjaman->mobil->users->nama ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('pengembalian-mobil.edit', $row->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
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

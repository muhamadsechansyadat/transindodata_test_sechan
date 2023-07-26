@extends('layouts.base')
@section('title-content')
    Manajemen
@endsection
@section('content')
    <h2 class="section-title">Manajemen Mobil</h2>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Manajemen Mobil</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('manajemen-mobil.create') }}" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Create</a>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        #
                                    </th>
                                    <th>Merek</th>
                                    <th>Model</th>
                                    <th>Nomor Plat</th>
                                    <th>Tarif(per-Hari)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $row->merek ?? '' }}</td>
                                        <td>{{ $row->model ?? '' }}</td>
                                        <td>{{ $row->nomor_plat ?? '' }}</td>
                                        <td>{{ "Rp " . number_format($row->tarif,2,',','.') }}</td>
                                        <td>
                                            <a href="{{ route('manajemen-mobil.edit', $row->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            <a href="{{ route('manajemen-mobil.delete', $row->id) }}" onclick="return confirm('are you sure?')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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

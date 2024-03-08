@extends('layouts.adminlte')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $judul }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Asal SMA</th>
                                    <th>Tahun Lulus</th>
                                    <th>Status Administrasi</th>
                                    <th>Status Hasil Ujian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenkel }}</td>
                                        <td>{{ $item->tanggal_lahir }}</td>
                                        <td>{{ $item->asal_sma }}</td>
                                        <td>{{ $item->tahun_lulus }}</td>
                                        <td class="text-bold {{ $color_list[$item->pendaftaran->status_admin] }}">
                                            {{ $item->pendaftaran->status_admin }}</td>
                                        <td class="text-bold {{ $color_list[$item->pendaftaran->status_ujian] }}">
                                            {{ $item->pendaftaran->status_ujian }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
@endsection

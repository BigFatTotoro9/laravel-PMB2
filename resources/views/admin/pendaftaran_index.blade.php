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
                                    <th>Jurusan</th>
                                    <th>Status Ujian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendaftaran as $item)
                                    <tr>
                                        <td>{{ $item->mahasiswa->nama }}</td>
                                        <td>
                                            @if ($item->jurusan_id != null)
                                                {{ $item->jurusan->jenis_jurusan }}
                                            @else
                                                Belum Memilih Jurusan
                                            @endif
                                        </td>
                                        <td class="text-bold {{ $color_list[$item->status_ujian] }}">
                                            @if ($item->status_ujian == 'belum lulus')
                                                <form method="POST"
                                                    action="{{ route('update.verifikasi.ujian', $item->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_ujian" value="Lulus">
                                                    <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                                </form>
                                                <br>
                                                <form method="POST"
                                                    action="{{ route('update.verifikasi.ujian', $item->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_ujian" value="Tidak Lulus">
                                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                                </form>
                                            @else
                                                {{ $item->status_ujian }}
                                            @endif
                                        </td>
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

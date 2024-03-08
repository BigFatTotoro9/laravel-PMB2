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
                                    <th>Pas Foto</th>
                                    <th>Ijasah</th>
                                    <th>KTP</th>
                                    <th>Status Administrasi</th>
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
                                        <td>
                                            @if ($item->mahasiswa->pas_foto != '')
                                                <div class="col-md-4 ">
                                                    <a href="{{ Storage::url($item->mahasiswa->pas_foto) }}" target="blank">
                                                        <img src="{{ Storage::url($item->mahasiswa->pas_foto) }}"
                                                            alt="pas_foto" width="100px" height="100px"
                                                            class="img img-thumbnail align-text-top">
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->mahasiswa->ijasah != '')
                                                <div class="col-md-4 ">
                                                    <a href="{{ Storage::url($item->mahasiswa->ijasah) }}" target="blank">
                                                        <img src="{{ Storage::url($item->mahasiswa->ijasah) }}"
                                                            alt="ijasah" width="100px" height="100px"
                                                            class="img img-thumbnail align-text-top">
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->mahasiswa->ktp != '')
                                                <div class="col-md-4 ">
                                                    <a href="{{ Storage::url($item->mahasiswa->ktp) }}" target="blank">
                                                        <img src="{{ Storage::url($item->mahasiswa->ktp) }}" alt="ktp"
                                                            width="100px" height="100px"
                                                            class="img img-thumbnail align-text-top">
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-bold {{ $color_list[$item->status_admin] }}">
                                            @if ($item->status_admin == 'belum lulus')
                                                <form method="POST"
                                                    action="{{ route('adminPendaftaran.update', $item->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_admin" value="Lulus">
                                                    <input type="hidden" name="status_ujian" value="belum lulus">
                                                    <button type="submit" class="btn btn-success">Terima</button>
                                                </form>
                                                <br>
                                                <form method="POST"
                                                    action="{{ route('adminPendaftaran.update', $item->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_admin" value="Tidak Lulus">
                                                    <input type="hidden" name="status_ujian" value="Tidak Lulus">
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </form>
                                            @else
                                                {{ $item->status_admin }}
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

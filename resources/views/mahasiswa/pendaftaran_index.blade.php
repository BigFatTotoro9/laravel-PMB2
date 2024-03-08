@extends('layouts.medilab')

@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>{{ $judul }}</h1>
        </div>
    </section>

    @if ($pendaftaran->isEmpty())
        <section id="faq" class="faq section-bg">
            <div class="container">
                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapsed"
                                data-bs-target="#faq-list-1">Belum ada pendaftaran yang diajukan<i
                                    class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-1" class="collapse" data-bs-parent=".faq-list">
                                <div class="col-md-4 mt-3">
                                    <a class="btn btn-primary py-1" href="#" role="button">Tambah Pendaftaran</a>
                                </div>
                            </div>
                        </li>
                </div>
            </div>
        </section>
    @endif

    <main id="main">
        <section id="doctors" class="doctors">
            <div class="container bg-white p-3">
                <div class="row">
                    @foreach ($pendaftaran as $item)
                        <div class="col-lg-6">
                            <div class="member d-flex align-items-start">
                                <div class="pic d-flex justify-content-center align-items-center">
                                    <img src="{{ Storage::url($item->mahasiswa->pas_foto) }}" class="img-fluid"
                                        alt="">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $item->mahasiswa->nama }}</h4>
                                    <strong></strong>
                                    <span>
                                        {{ $item->jurusan_id ? $item->jurusan->jenis_jurusan : 'Belum memilih jurusan' }}
                                    </span>
                                    {{-- <span>{{ $item->tanggal_lahir }}</span> --}}
                                    <p class="text-secondary">Status Administrasi : {{ $item->status_admin }}</p>
                                    <p class="text-secondary">Status Ujian : {{ $item->status_ujian }}</p>
                                    <br>
                                    @if ($item->jurusan_id == null)
                                        <form action="/pendaftaran/{{ $item->id }}" method="POST" class="form-inline"
                                            onsubmit="return confirm('Kunci Pilihan?')">
                                            @method('PUT')
                                            @csrf
                                            <div class="form-group mt-2">
                                                <select name="jurusan_id" class="form-control mt-1">
                                                    @foreach ($list_jurusan as $jurusan)
                                                        <option value="{{ $jurusan->id }}">
                                                            {{ $jurusan->jenis_jurusan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="text-danger">{{ $errors->first('jurusan_id') }}</span>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-2">Simpan Jurusan</button>
                                        </form>
                                    @endif
                                    <br>
                                    {!! Form::open([
                                        'route' => ['pendaftaran.destroy', $item->id],
                                        'method' => 'delete',
                                        'onsubmit' => 'return confirm("Yakin mau dihapus?")',
                                    ]) !!}
                                    {!! Form::submit('Hapus', ['class' => 'btn btn-md btn-danger']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection

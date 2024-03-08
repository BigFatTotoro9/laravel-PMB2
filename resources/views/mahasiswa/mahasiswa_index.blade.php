@extends('layouts.medilab')

@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>{{ $judul }}</h1>
        </div>
    </section>

    @if ($mahasiswa->isEmpty())
        <section id="faq" class="faq section-bg">
            <div class="container">
                <div class="faq-list">
                    <ul>
                        <li data-aos="fade-up" data-aos-delay="100">
                            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapsed"
                                data-bs-target="#faq-list-1">Belum ada Mahasiswa yang didaftarkan<i
                                    class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-1" class="collapse" data-bs-parent=".faq-list">
                                <div class="col-md-4 mt-3">
                                    <a class="btn btn-primary py-1" href="{{ route('mahasiswa.create') }}"
                                        role="button">Tambah Pendaftaran</a>
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
                    @foreach ($mahasiswa as $item)
                        <div class="col-lg-6">
                            <div class="member d-flex align-items-start">
                                <div class="pic d-flex justify-content-center align-items-center">
                                    <img src="{{ Storage::url($item->pas_foto) }}" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>{{ $item->nama }}</h4>
                                    <span>{{ $item->tanggal_lahir }}</span>
                                    <p class="text-secondary">{{ $item->asal_sma }} - {{ $item->tahun_lulus }}</p>
                                    <br>
                                    <div class="">
                                        <a href="{{ route('mahasiswa.edit', $item->id) }}" class="btn btn-primary my-2"
                                            role="button">Edit Profil</a>
                                        <a href="{{ route('dokumen.edit', $item->id) }}" class="btn btn-warning"
                                            role="button">Submit Dokumen</a>
                                    </div>
                                    <hr>
                                    <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </main>
@endsection

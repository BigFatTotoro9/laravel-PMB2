@extends('layouts.medilab')

@section('content')
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>{{ $judul }}</h1>
        </div>
    </section>

    <section id="contact" class="contact">
        <div class="container">
            <div class="row mt-1">

                <div class="col-lg-8 mt-5 mt-lg-10">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                    {!! Form::model($mahasiswa, ['route' => $route, 'method' => $method]) !!}
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        {!! Form::text('nama', null, ['class' => 'form-control mb-3']) !!}
                        <span class="text-danger">
                            {{ $errors->first('nama') }}
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="jenkel">Jenis Kelamin</label>
                        {!! Form::select('jenkel', $list_jenkel, null, ['class' => 'form-control mb-3']) !!}
                        <span class="text-danger">
                            {{ $errors->first('jenkel') }}
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        {!! Form::date('tanggal_lahir', null, ['class' => 'form-control mb-3']) !!}
                        <span class="text-danger">
                            {{ $errors->first('tanggal_lahir') }}
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="asal_sma">Asal SMA</label>
                        {!! Form::text('asal_sma', null, ['class' => 'form-control mb-3']) !!}
                        <span class="text-danger">
                            {{ $errors->first('asal_sma') }}
                        </span>
                    </div>

                    <div class="form-group">
                        <label for="tahun_lulus">Tahun Lulus</label>
                        {!! Form::selectRange('tahun_lulus', '2010', '2024', null, ['class' => 'form-control mb-3']) !!}
                        <span class="text-danger">
                            {{ $errors->first('tahun_lulus') }}
                        </span>
                    </div>
                    <br>
                    <div class="form-group">
                        {!! Form::submit('SUBMIT', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
@endsection

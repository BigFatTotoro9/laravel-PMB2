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

                    {!! Form::model($mahasiswa, ['route' => $route, 'method' => $method, 'enctype' => 'multipart/form-data']) !!}

                    <div class="form-group mt-3">
                        <div class="col d-flex align-content-between">
                            <div class="me-5">
                                <label for="pas_foto">Pas Foto</label>
                                <input class="form-control" type="file" name="pas_foto" value="{{ old('pas_foto') }}">
                                <span class="text-danger">{{ $errors->first('pas_foto') }}</span>
                            </div>
                            @if ($mahasiswa->pas_foto != '')
                                <div class="col-md-4 ">
                                    <a href="{{ Storage::url($mahasiswa->pas_foto) }}" target="blank">
                                        <img src="{{ Storage::url($mahasiswa->pas_foto) }}" alt="pas_foto" width="100px"
                                            height="100px" class="img img-thumbnail align-text-top">
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="col d-flex align-content-between">
                            <div class="me-5">
                                <label for="ijasah">Ijasah</label>
                                <input class="form-control" type="file" name="ijasah" value="{{ old('ijasah') }}">
                                <span class="text-danger">{{ $errors->first('ijasah') }}</span>
                            </div>
                            @if ($mahasiswa->pas_foto != '')
                                <div class="col-md-4 ">
                                    <a href="{{ Storage::url($mahasiswa->pas_foto) }}" target="blank">
                                        <img src="{{ Storage::url($mahasiswa->pas_foto) }}" alt="pas_foto" width="100px"
                                            height="100px" class="img img-thumbnail align-text-top">
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <div class="col d-flex align-content-center">
                            <div class="me-5">
                                <label for="ktp">KTP</label>
                                <input class="form-control" type="file" name="ktp" value="{{ old('ktp') }}">
                                <span class="text-danger">{{ $errors->first('ktp') }}</span>
                            </div>
                            @if ($mahasiswa->pas_foto != '')
                                <div class="col-md-4 ">
                                    <a href="{{ Storage::url($mahasiswa->pas_foto) }}" target="blank">
                                        <img src="{{ Storage::url($mahasiswa->pas_foto) }}" alt="pas_foto" width="100px"
                                            height="100px" class="img img-thumbnail align-text-top">
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
@endsection

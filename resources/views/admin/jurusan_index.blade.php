@extends('layouts.adminlte')

@section('content')
    <div class="row">
        @foreach ($jurusan as $item)
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box {{ $list_warna[$loop->iteration % 4] }}">
                    <div class="inner">
                        <h3>{{ $item->jumlah_pendaftar }}</h3>

                        <p>{{ $item->jenis_jurusan }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-university"></i>
                    </div>
                    <a href="{{ route('jurusan.show', $item->id) }}" class="small-box-footer">More info<i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        @endforeach
        <!-- ./col -->
    </div>

    <div class="col-lg-3">
        <div class="card-body">
            {!! Form::model($jurusan, ['route' => 'jurusan.store', 'method' => 'POST']) !!}

            <div class="form-group mt-1">
                <label for="jenis_jurusan">Jenis Jurusan</label>
                <input class="form-control"type="text" name="jenis_jurusan" value="{{ old('jenis_jurusan') }}">
                <span class="text-danger">{{ $errors->first('jenis_jurusan') }}</span>
            </div>

            <div class="form-group mt-1">
                <label for="dekripsi">Deskripsi</label>
                {!! Form::textarea('deskripsi', null, ['class' => 'form-control', 'placeholder' => 'Type deskripsi here']) !!}
                <span class="text-danger">{{ $errors->first('dekripsi') }}</span>
            </div>

            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary"> SIMPAN </button>
            </div>
            </form>
        </div>
    </div>
@endsection

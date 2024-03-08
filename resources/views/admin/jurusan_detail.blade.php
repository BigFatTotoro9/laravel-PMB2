@extends('layouts.adminlte')

@section('content')
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ $jurusan->jenis_jurusan }}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                {{ $jurusan->deskripsi }}
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                {!! Form::open([
                    'route' => ['jurusan.destroy', $jurusan->id],
                    'method' => 'delete',
                    'onsubmit' => 'return confirm("Yakin mau dihapus?")',
                ]) !!}
                {!! Form::submit('Hapus', ['class' => 'btn btn-md btn-danger']) !!}
                {!! Form::close() !!} </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
@endsection

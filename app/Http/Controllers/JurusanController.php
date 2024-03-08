<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['jurusan'] = Jurusan::all();
        $data['judul'] = 'Daftar Jurusan';
        $data['title'] = "Jurusan | Dashboard";
        $data['list_warna'] = [
            '0' => 'bg-aqua',
            '1' => 'bg-green',
            '2' => 'bg-yellow',
            '3' => 'bg-red',
        ];

        return view('admin.jurusan_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['jurusan'] = new \App\Models\Jurusan();
        $data['route'] = 'jurusan.store';
        $data['method'] = 'POST';
        $data['tombol'] = 'SIMPAN';
        $data['judul'] = 'Tambah Jurusan';
        $data['title'] = "Jurusan | Admission";


        return view('admin.jurusan_index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'jenis_jurusan' => 'required',
            'jumlah_pendaftar' => 'nullable',
            'deskripsi' => 'required',
        ]);

        $jurusan = new Jurusan();
        $jurusan->fill($validasiData);
        $jurusan->save();

        flash('Data berhasil disimpan');
        return back();
    }

    public function show(string $id)
    {
        $data['jurusan'] = Jurusan::findOrFail($id);

        return view('admin.jurusan_detail', $data);
    }

    public function destroy(string $id)
    {
        $jurusan = Jurusan::findOrFail($id);
        // if ($jurusan->pendaftaran && $jurusan->pendaftaran->count() >= 1) {
        //     flash('Data tidak bisa dihapus karena sudah digunakan')->error();
        //     return redirect()->route('jurusan.index');
        // }
        $jurusan->delete();
        flash('Data berhasil dihapus');
        return redirect()->route('jurusan.index');
    }
}

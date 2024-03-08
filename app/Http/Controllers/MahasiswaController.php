<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $data['mahasiswa'] = Mahasiswa::where('user_id', '=', $userId)->get();
        $data['judul'] = 'Data Mahasiswa';

        return view('mahasiswa.mahasiswa_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['mahasiswa'] = new Mahasiswa();
        $data['judul'] = 'Form Data Diri';
        $data['method'] = 'POST';
        $data['route'] = 'mahasiswa.store';
        $data['title'] = 'Mahasiswa | Admission';

        $data['list_jenkel'] = [
            'laki-laki' => 'Laki-Laki',
            'perempuan' => 'Perempuan',
        ];

        return view('mahasiswa.datadiri_form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate(
            [
                'nama' => 'required',
                'jenkel' => 'required',
                'tanggal_lahir' => 'required',
                'asal_sma' => 'required',
                'tahun_lulus' => 'required',
            ]
        );
        DB::beginTransaction();
        try {
            $userId = Auth::user()->id;
            $mahasiswa = new Mahasiswa();
            $pendaftaran = new Pendaftaran();
            $mahasiswa->user_id = $userId;
            $mahasiswa->nama = $request->nama;
            $mahasiswa->jenkel = $request->jenkel;
            $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
            $mahasiswa->asal_sma = $request->asal_sma;
            $mahasiswa->tahun_lulus = $request->tahun_lulus;
            $mahasiswa->save();

            $pendaftaran->mahasiswa_id = $mahasiswa->id;
            $pendaftaran->save();
            DB::commit();
            flash('Data berhasil disimpan');
            return redirect()->route('pendaftaran.index');
        } catch (\Throwable $e) {
            DB::rollback();
            flash('Ops... Terjadi kesalahan,' . $e->getMessage())->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['mahasiswa'] = Mahasiswa::findOrFail($id);
        $data['judul'] = 'Edit Data Diri';
        $data['method'] = 'PUT';
        $data['route'] = ['mahasiswa.update', $id];
        $data['title'] = 'Mahasiswa | Admission';

        $data['list_jenkel'] = [
            'laki-laki' => 'Laki-Laki',
            'perempuan' => 'Perempuan',
        ];

        return view('mahasiswa.datadiri_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate(
            [
                'nama' => 'required',
                'jenkel' => 'required',
                'tanggal_lahir' => 'required',
                'asal_sma' => 'required',
                'tahun_lulus' => 'required',
            ]
        );
        DB::beginTransaction();
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            $mahasiswa->nama = $request->nama;
            $mahasiswa->jenkel = $request->jenkel;
            $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
            $mahasiswa->asal_sma = $request->asal_sma;
            $mahasiswa->tahun_lulus = $request->tahun_lulus;
            $mahasiswa->save();

            DB::commit();
            flash('Data berhasil disimpan');
            return redirect()->route('mahasiswa.index');
        } catch (\Throwable $e) {
            DB::rollback();
            flash('Ops... Terjadi kesalahan,' . $e->getMessage())->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        if ($mahasiswa->pendaftaran && $mahasiswa->pendaftaran->count() >= 1) {
            flash('Data tidak bisa dihapus karena sudah digunakan')->error();
            return back();
        }
        $mahasiswa->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}

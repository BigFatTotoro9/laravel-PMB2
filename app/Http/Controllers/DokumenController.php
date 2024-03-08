<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        $data['judul'] = 'Edit Dokumen';
        $data['method'] = 'PUT';
        $data['route'] = ['dokumen.update', $id];
        $data['title'] = 'Mahasiswa | Admission';

        return view('mahasiswa.dokumen_form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate(
            [
                'pas_foto' => 'nullable|image|mimes:jpg,jpeg,png|max:8048',
                'ijasah' => 'nullable|image|mimes:jpg,jpeg,png|max:8048',
                'ktp' => 'nullable|image|mimes:jpg,jpeg,png|max:8048',
            ]
        );

        DB::beginTransaction();
        try {
            $mahasiswa = Mahasiswa::findOrFail($id);
            if ($request->hasFile('pas_foto') || $request->hasFile('ijasah') || $request->hasFile('ktp')) {
                //buang foto dari validasi data
                unset($validation['pas_foto']);
                unset($validation['ijasah']);
                unset($validation['ktp']);
                $pathPasFoto = $request->file('pas_foto')->store('public/dokumen_mahasiswa');
                $pathIjasah = $request->file('ijasah')->store('public/dokumen_mahasiswa');
                $pathKtp = $request->file('ktp')->store('public/dokumen_mahasiswa');
                $mahasiswa->pas_foto = $pathPasFoto;
                $mahasiswa->ijasah = $pathIjasah;
                $mahasiswa->ktp = $pathKtp;
            }
            $mahasiswa->save();
            DB::commit();
            flash('Data berhasil disimpan');
            return redirect()->route('mahasiswa.index');
        } catch (\Throwable $e) {
            DB::rollback();
            flash('Ops... Terjadi kesalahan,' . $e->getMessage())->error();
            return redirect()->route('mahasiswa.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

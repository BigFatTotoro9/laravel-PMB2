<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userID = Auth::user()->id; // Replace this with the specific user ID you want to retrieve pendaftaran records for

        $data['pendaftaran'] = Pendaftaran::whereHas('mahasiswa.user', function ($query) use ($userID) {
            $query->where('users.id', $userID);
        })->get();
        $data['judul'] = 'Dashboard Pendaftaran';
        $data['list_jurusan'] = Jurusan::get();

        return view('mahasiswa.pendaftaran_index', $data);
    }

    
    public function update(Request $request, string $id)
    {
        $validation = $request->validate(['jurusan_id' => 'required']);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->fill($validation);
        $pendaftaran->save();
        DB::table('jurusans')->where('id', $pendaftaran->jurusan_id)->increment('jumlah_pendaftar', 1);

        return redirect()->route('pendaftaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();
        flash('Data berhasil dihapus');
        return back();
    }
}

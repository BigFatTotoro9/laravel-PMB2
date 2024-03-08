<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userRole = Auth::user()->role;

        // Render different views based on user role
        if ($userRole === 'admin') {
            return view('admin.home');
        } elseif ($userRole === 'mahasiswa') {
            $data['jurusan'] = Jurusan::all();
            return view('mahasiswa.home', $data);
        } else {
            return view('home');
        }
    }
}

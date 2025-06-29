<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SriKategori;
use App\Models\SriEvent;
use App\Models\SriPengumuman;
use App\Models\SriPendaftaran;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalKategori' => SriKategori::count(),
            'totalEvent' => SriEvent::count(),
            'totalPengumuman' => SriPengumuman::count(),
            'totalPendaftaran' => SriPendaftaran::count(),
        ]);
    }
}

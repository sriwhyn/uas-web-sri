<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SriPendaftaran;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftaran dengan filter status_pendaftaran.
     */
    public function index(Request $request)
    {
        $query = SriPendaftaran::with(['user', 'event'])->latest();

        // Filter berdasarkan status_pendaftaran (mahasiswa / umum)
        if ($request->filled('status_peserta')) {
            $query->where('status_pendaftaran', $request->status_peserta);
        }

        $pendaftaran = $query->get();

        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }

    /**
     * Menampilkan detail dari satu pendaftaran berdasarkan ID.
     */
    public function show($id)
    {
        $pendaftaran = SriPendaftaran::with(['user', 'event'])->findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    /**
     * Menghapus data pendaftaran berdasarkan ID.
     */
    public function destroy($id)
    {
        $pendaftaran = SriPendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()
            ->route('admin.pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil dihapus.');
    }
}

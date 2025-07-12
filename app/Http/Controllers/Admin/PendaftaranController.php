<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SriPendaftaran;
use App\Models\User;
use App\Models\SriEvent;

class PendaftaranController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftaran.
     */
    public function index()
    {
        $pendaftaran = SriPendaftaran::with(['user', 'event'])->latest()->get();
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
     * Memperbarui status dari pendaftaran.
     */
    public function update(Request $request, $id)
    {
        $pendaftaran = SriPendaftaran::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak',
        ]);

        $pendaftaran->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.pendaftaran.show', $pendaftaran->id)
            ->with('success', 'Status pendaftaran berhasil diperbarui.');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SriPendaftaran;
use App\Models\User; // Pastikan model User diimpor
use App\Models\SriEvent; // Pastikan model SriEvent diimpor

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = SriPendaftaran::with(['user', 'event'])->latest()->get();
        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }

    public function show($id)
    {
        // Pastikan variabel $pendaftaran diambil dan dilewatkan ke view
        $pendaftaran = SriPendaftaran::with(['user', 'event'])->findOrFail($id);
        return view('admin.pendaftaran.show', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = SriPendaftaran::findOrFail($id);

        $request->validate([
            'status' => 'required|in:menunggu,disetujui,ditolak',
        ]);

        $pendaftaran->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pendaftaran.show', $pendaftaran->id)->with('success', 'Status pendaftaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pendaftaran = SriPendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil dihapus.');
    }
}

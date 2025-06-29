<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SriPengumuman;

class PengumumanController extends Controller
{
    // Tampilkan semua pengumuman
    public function index()
    {
        $pengumuman = SriPengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    // Tampilkan form tambah pengumuman
    public function create()
    {
        return view('admin.pengumuman.create');
    }

    // Simpan data pengumuman baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        SriPengumuman::create($request->only(['judul', 'isi']));

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    // Tampilkan form edit pengumuman
    public function edit($id)
    {
        $pengumuman = SriPengumuman::findOrFail($id);
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    // Update data pengumuman
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $pengumuman = SriPengumuman::findOrFail($id);
        $pengumuman->update($request->only(['judul', 'isi']));

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    // Hapus data pengumuman
    public function destroy($id)
    {
        $pengumuman = SriPengumuman::findOrFail($id);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}

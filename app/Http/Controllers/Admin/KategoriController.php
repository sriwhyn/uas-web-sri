<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SriKategori; // Pastikan model SriKategori diimpor
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator facade

class KategoriController extends Controller
{
    /**
     * Tampilkan daftar kategori.
     */
    public function index()
    {
        $kategoris = SriKategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     * Metode ini tidak lagi digunakan sebagai halaman terpisah,
     * karena form sekarang ada di dalam modal pada halaman index.
     */
    // public function create()
    // {
    //     return view('admin.kategori.create');
    // }

    /**
     * Simpan kategori baru ke database.
     * Menangani permintaan AJAX dan non-AJAX.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:sri_kategori,nama_kategori',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $kategori = SriKategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => 'Kategori berhasil ditambahkan!', 'kategori' => $kategori]);
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan form untuk mengedit kategori.
     */
    public function edit(SriKategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Perbarui kategori di database.
     */
    public function update(Request $request, SriKategori $kategori)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:sri_kategori,nama_kategori,' . $kategori->id,
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator)->withInput();
        }

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => 'Kategori berhasil diperbarui!', 'kategori' => $kategori]);
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori dari database.
     * Menangani permintaan AJAX dan non-AJAX.
     */
    public function destroy(SriKategori $kategori)
    {
        $kategori->delete();

        if (request()->ajax()) { // Menggunakan request() helper untuk memeriksa AJAX
            return response()->json(['success' => 'Kategori berhasil dihapus!']);
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}

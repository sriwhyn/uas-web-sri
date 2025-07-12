<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SriKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
     * Simpan kategori baru.
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

        // Set zona waktu Asia/Jakarta untuk respons AJAX
        if ($request->ajax()) {
            $kategori->created_at = $kategori->created_at->timezone('Asia/Jakarta')->toDateTimeString();
            return response()->json([
                'success' => 'Kategori berhasil ditambahkan!',
                'kategori' => $kategori
            ]);
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit.
     */
    public function edit(SriKategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    /**
     * Perbarui kategori.
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
            return response()->json([
                'success' => 'Kategori berhasil diperbarui!',
                'kategori' => $kategori
            ]);
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori.
     */
    public function destroy(SriKategori $kategori)
    {
        $kategori->delete();

        if (request()->ajax()) {
            return response()->json(['success' => 'Kategori berhasil dihapus!']);
        }

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}

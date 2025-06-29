<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SriEvent;
use App\Models\SriKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = SriEvent::with('kategori')->latest()->get();
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        $kategori = SriKategori::all();
        return view('admin.event.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'kategori_id' => 'required|exists:sri_kategori,id',
            'gambar' => 'nullable|image|max:2048',
            'kuota' => 'nullable|integer|min:1', // Tambahkan validasi kuota
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar-event', 'public');
        }

        SriEvent::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_pelaksanaan' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'kategori_id' => $request->kategori_id,
            'gambar' => $gambar,
            'kuota' => $request->kuota,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function show($id)
    {
        $event = SriEvent::with('kategori')->findOrFail($id);
        return view('admin.event.show', compact('event'));
    }

    public function edit($id)
    {
        $event = SriEvent::findOrFail($id);
        $kategori = SriKategori::all();
        return view('admin.event.edit', compact('event', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $event = SriEvent::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
            'kategori_id' => 'required|exists:sri_kategori,id',
            'gambar' => 'nullable|image|max:2048',
            'kuota' => 'nullable|integer|min:1', // Tambahkan validasi kuota
        ]);

        if ($request->hasFile('gambar')) {
            if ($event->gambar) {
                Storage::disk('public')->delete($event->gambar);
            }
            $event->gambar = $request->file('gambar')->store('gambar-event', 'public');
        }

        $event->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_pelaksanaan' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'kategori_id' => $request->kategori_id,
            'kuota' => $request->kuota,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = SriEvent::findOrFail($id);
        if ($event->gambar) {
            Storage::disk('public')->delete($event->gambar);
        }
        $event->delete();

        return redirect()->route('admin.event.index')->with('success', 'Event berhasil dihapus.');
    }
}

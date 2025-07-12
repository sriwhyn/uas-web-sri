<?php

namespace App\Http\Controllers;

use App\Models\SriEvent;
use App\Models\SriKategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SriPengumuman;
use App\Models\SriPendaftaran;
use Illuminate\Support\Facades\Auth;

class FrontController extends Controller
{
    public function rootRedirect()
    {
        return Auth::check()
            ? (Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('beranda'))
            : redirect()->route('beranda');
    }

    public function index()
    {
        // Hanya ambil 6 event terbaru
        $events = SriEvent::latest()->take(6)->get();
        $pengumumans = SriPengumuman::latest()->get();
        return view('front.beranda', compact('events', 'pengumumans'));
    }

    public function eventSemua(Request $request)
{
    $kategoriList = SriKategori::all();
    $kategoriId = $request->query('kategori');

    $query = SriEvent::with('kategori')->latest();

    if ($kategoriId) {
        $query->where('kategori_id', $kategoriId);
    }

    $events = $query->paginate(6)->withQueryString(); // pakai paginate

    return view('front.event_semua', [
        'events' => $events,
        'kategoriList' => $kategoriList,
        'kategoriId' => $kategoriId,
    ]);
}



    public function eventDetail($id)
    {
        $event = SriEvent::with('kategori', 'pendaftarans')->findOrFail($id);
        return view('front.detail', compact('event'));
    }

    public function formDaftar($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar event.');
        }

        $event = SriEvent::findOrFail($id);

        // Cek apakah user sudah mendaftar
        $sudahDaftar = $event->pendaftarans()->where('user_id', Auth::id())->exists();

        if ($sudahDaftar) {
            return redirect()->route('event.detail', $id)->with('error', 'Anda sudah mendaftar event ini.');
        }

        return view('front.form_daftar', compact('event'));
    }

    public function daftar(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mendaftar event.');
        }

        $request->validate([
            'event_id' => 'required|exists:sri_event,id',
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20',
            'jurusan' => 'required|string|max:100',
            'prodi' => 'required|string|max:100',
        ]);

        $user = Auth::user();
        $event = SriEvent::with('pendaftarans')->findOrFail($request->event_id);

        // Cek apakah user sudah mendaftar
        if ($event->pendaftarans->where('user_id', $user->id)->count()) {
            return redirect()->route('event.detail', $event->id)->with('error', 'Anda sudah terdaftar untuk event ini.');
        }

        // Cek kuota
        if (!is_null($event->kuota) && $event->pendaftarans->count() >= $event->kuota) {
            return redirect()->route('event.detail', $event->id)->with('error', 'Maaf, kuota pendaftaran sudah penuh.');
        }

        // Buat kode pendaftaran unik
        $kodePendaftaran = 'REG-' . strtoupper(Str::random(8));
        while (SriPendaftaran::where('kode_pendaftaran', $kodePendaftaran)->exists()) {
            $kodePendaftaran = 'REG-' . strtoupper(Str::random(8));
        }

        // Simpan data pendaftaran
        SriPendaftaran::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'prodi' => $request->prodi,
            'status' => 'disetujui',
            'kode_pendaftaran' => $kodePendaftaran,
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('event.detail', $event->id)->with('success', 'Pendaftaran berhasil!');
    }
}

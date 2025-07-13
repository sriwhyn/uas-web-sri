<?php

namespace App\Http\Controllers;

use App\Models\SriEvent;
use App\Models\SriKategori;
use App\Models\SriPengumuman;
use App\Models\SriPendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
        $events = SriEvent::latest()->take(6)->get();
        $pengumumans = SriPengumuman::latest()->take(6)->get();

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

        $events = $query->paginate(6)->withQueryString();

        return view('front.event_semua', [
            'events' => $events,
            'kategoriList' => $kategoriList,
            'kategoriId' => $kategoriId,
        ]);
    }

    public function pengumumanSemua(Request $request)
    {
        $search = $request->query('search');
        $query = SriPengumuman::query();

        if ($search) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        $pengumumans = $query->latest()->paginate(6)->withQueryString();

        return view('front.pengumuman_semua', compact('pengumumans', 'search'));
    }

    public function pengumumanDetail($id)
    {
        $pengumuman = SriPengumuman::findOrFail($id);
        return view('front.pengumuman_detail', compact('pengumuman'));
    }

    public function suggestPengumuman(Request $request)
    {
        $query = $request->get('query');

        $results = SriPengumuman::where('judul', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['id', 'judul']);

        return response()->json($results);
    }

    public function eventDetail($id)
    {
        $event = SriEvent::with('kategori', 'pendaftarans')->findOrFail($id);
        return view('front.detail', compact('event'));
    }

    public function formDaftar($id)
    {
        if (!Auth::check()) {
            session(['url.intended' => route('event.form.daftar', $id)]);
            return redirect()->route('login')->with('error', 'Silakan login untuk mendaftar.');
        }

        $event = SriEvent::findOrFail($id);

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
            'status_pendaftaran' => 'required|in:mahasiswa,umum',
            'nim' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:100',
            'prodi' => 'nullable|string|max:100',
            'institusi' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $event = SriEvent::with('pendaftarans')->findOrFail($request->event_id);

        if ($event->pendaftarans->where('user_id', $user->id)->count()) {
            return redirect()->route('event.detail', $event->id)->with('error', 'Anda sudah terdaftar untuk event ini.');
        }

        if (!is_null($event->kuota) && $event->pendaftarans->count() >= $event->kuota) {
            return redirect()->route('event.detail', $event->id)->with('error', 'Maaf, kuota pendaftaran sudah penuh.');
        }

        SriPendaftaran::create([
            'user_id' => $user->id,
            'event_id' => $event->id,
            'nama' => $request->nama,
            'nim' => $request->nim,
            'jurusan' => $request->jurusan,
            'prodi' => $request->prodi,
            'institusi' => $request->institusi,
            'status' => 'terdaftar',
            'status_pendaftaran' => $request->status_pendaftaran,
            'kode_pendaftaran' => 'REG-' . strtoupper(Str::random(8)),
            'tanggal_daftar' => now(),
        ]);

        return redirect()->route('event.detail', $event->id)->with('success', 'Pendaftaran berhasil!');
    }

    public function eventSaya()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $eventSaya = $user->pendaftarans()->with('event')->latest('tanggal_daftar')->get();

        return view('front.event_saya', compact('eventSaya'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SriEvent;
use App\Models\SriPendaftaran;
use Illuminate\Support\Str;
use App\Models\SriPengumuman;

    class FrontController extends Controller
    {
        public function rootRedirect()
        {
            if (Auth::check()) {
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }
                return redirect()->route('beranda');
            }
            return redirect()->route('beranda');
        }

        public function index()
        {
            $events = SriEvent::latest()->get();
            $pengumumans = SriPengumuman::latest()->get(); // Pastikan baris ini ada
            return view('front.beranda', compact('events', 'pengumumans')); // Pastikan variabel $pengumumans dikirim
        }

        public function eventDetail($id)
        {
            $event = SriEvent::with('kategori')->findOrFail($id);
            return view('front.detail', compact('event'));
        }

        public function daftar(Request $request)
        {
            if (!Auth::check()) {
                return redirect()->route('login')->with('error', 'Anda harus login untuk mendaftar event.');
            }

            $request->validate([
                'event_id' => 'required|exists:sri_event,id',
            ]);

            $user = Auth::user();
            $eventId = $request->event_id;

            $existingPendaftaran = SriPendaftaran::where('user_id', $user->id)
                                                 ->where('event_id', $eventId)
                                                 ->first();

            if ($existingPendaftaran) {
                return back()->with('error', 'Anda sudah terdaftar untuk event ini.');
            }

            $event = SriEvent::findOrFail($eventId);

            if ($event->kuota !== null && $event->kuota <= SriPendaftaran::where('event_id', $eventId)->count()) {
                return back()->with('error', 'Maaf, kuota pendaftaran untuk event ini sudah penuh.');
            }

            $kodePendaftaran = 'REG-' . strtoupper(Str::random(8));
            while (SriPendaftaran::where('kode_pendaftaran', $kodePendaftaran)->exists()) {
                $kodePendaftaran = 'REG-' . strtoupper(Str::random(8));
            }

            SriPendaftaran::create([
                'user_id' => $user->id,
                'event_id' => $eventId,
                'status' => 'disetujui',
                'kode_pendaftaran' => $kodePendaftaran,
                'tanggal_daftar' => now(),
            ]);

            return back()->with('success', 'Anda berhasil mendaftar event! Status pendaftaran Anda langsung terdaftar.');
        }
    }
    
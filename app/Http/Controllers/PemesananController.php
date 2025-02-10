<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Jadwal;
use App\Models\Seat;
use App\Models\Bandara;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function listTiket(Request $request)
    {
        $query = Jadwal::query()
            ->with(['maskapai', 'bandaraKeberangkatan', 'bandaraTujuan'])
            ->whereDate('date', '>=', Carbon::today()); // Ubah 'tanggal' menjadi 'date'

        // Filter berdasarkan bandara asal
        if ($request->filled('from')) {
            $query->where('keberangkatan', $request->from); // Sesuaikan dengan nama kolom di model
        }

        // Filter berdasarkan bandara tujuan
        if ($request->filled('to')) {
            $query->where('tujuan', $request->to); // Sesuaikan dengan nama kolom di model
        }

        // Filter berdasarkan tanggal yang dipilih
        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $jadwals = $query->orderBy('date', 'asc')
                        ->orderBy('boarding_time', 'asc')
                        ->get();

        $bandaras = Bandara::orderBy('nama_bandara')->get();

        return view('user.list-tiket', compact('jadwals', 'bandaras'));
    }

    // Menampilkan form pemesanan berdasarkan jadwal yang dipilih
    public function create($no_penerbangan)
    {
        $jadwal = Jadwal::with(['maskapai', 'bandaraKeberangkatan', 'bandaraTujuan'])
            ->where('no_penerbangan', $no_penerbangan)
            ->firstOrFail();

        // Pastikan maskapai dan kursi_perbaris ada
        if (!$jadwal->maskapai || !$jadwal->maskapai->kursi_perbaris) {
            return redirect()->back()->with('error', 'Data maskapai tidak lengkap');
        }

        // Ambil kursi yang belum dipesan
        $seats = Seat::where('id_pesawat', $jadwal->id_pesawat)
            ->whereNotIn('bangku_code', function($query) use ($no_penerbangan) {
                $query->select('bangku_code')
                    ->from('pemesanans')
                    ->where('no_penerbangan', $no_penerbangan);
            })
            ->get();

        return view('user.pemesanan-form', compact('jadwal', 'seats'));
    }

    // Menyimpan data pemesanan
    public function store(Request $request)
    {
        $request->validate([
            'no_penerbangan' => 'required|exists:jadwal,no_penerbangan',
            'bangku_code' => 'required|array',
            'bangku_code.*' => 'exists:seats,bangku_code',
            'pembayaran' => 'required|in:DANA,OVO,GoPay,Bank Transfer',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil data jadwal untuk mendapatkan harga
        $jadwal = Jadwal::where('no_penerbangan', $request->no_penerbangan)->first();

        // Hitung total pembayaran
        $totalPayment = $jadwal->harga * count($request->bangku_code);

        // Simpan file dengan visibility public
        $buktiPembayaranPath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Buat nomor pemesanan unik
        $noPemesanan = uniqid('ORD-');

        foreach ($request->bangku_code as $bangku) {
            Pemesanan::create([
                'no_pemesanan' => $noPemesanan,
                'no_penerbangan' => $request->no_penerbangan,
                'bangku_code' => $bangku,
                'jumlah_penumpang' => count($request->bangku_code),
                'pembayaran' => $request->pembayaran,
                'bukti_pembayaran' => $buktiPembayaranPath,
                'status_pesanan' => 'Pending',
                'total_harga' => $totalPayment,
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('tiket.my-tickets')->with('success', 'Pemesanan berhasil dilakukan!');
    }

    public function myTickets()
    {
        $tickets = Pemesanan::with(['jadwal.maskapai', 'jadwal.bandaraKeberangkatan', 'jadwal.bandaraTujuan'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('no_pemesanan');

        return view('user.my-tickets', compact('tickets'));
    }

    public function konfirmasiPesanan()
    {
        $pesanans = Pemesanan::with(['jadwal.maskapai', 'jadwal.bandaraKeberangkatan', 'jadwal.bandaraTujuan', 'user'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('no_pemesanan');

        return view('admin.konfirmasi-pesanan', compact('pesanans'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'status_pesanan' => 'required|in:Pending,Confirmed,Cancelled'
            ]);

            Pemesanan::find($request->id)
                ->update(['status_pesanan' => $request->status_pesanan]);

            return redirect()->back()->with('success', 'Selamat');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status: ' . $e->getMessage()
            ], 500);
        }
    }
}

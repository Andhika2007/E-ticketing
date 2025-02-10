<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Maskapai;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return $this->adminDashboard();
        }

        return $this->userDashboard();
    }

    private function adminDashboard()
    {
        $data = [
            'totalPesanan' => Pemesanan::count(),
            'pesananPending' => Pemesanan::where('status_pesanan', 'Pending')->count(),
            'totalMaskapai' => Maskapai::count(),
            'totalUsers' => User::where('role', 'customer')->count(),
            'pesananTerbaru' => Pemesanan::with('user')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
        ];

        return view('admin.dashboard', $data);
    }

    private function userDashboard()
    {
        $userId = Auth::id();

        $data = [
            'totalPesanan' => Pemesanan::where('user_id', $userId)->count(),
            'pesananPending' => Pemesanan::where('user_id', $userId)
                ->where('status_pesanan', 'Pending')
                ->count(),
            'pesananConfirmed' => Pemesanan::where('user_id', $userId)
                ->where('status_pesanan', 'Confirmed')
                ->count(),
            'pesananTerbaru' => Pemesanan::with('jadwal.maskapai')
                ->where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
        ];

        return view('user.dashboard', $data);
    }
}

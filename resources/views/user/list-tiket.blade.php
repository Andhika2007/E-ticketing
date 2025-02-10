<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Tiket') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <!-- Filter Section -->
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Cari Penerbangan</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tiket.list') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Dari</label>
                                    <select name="from" class="form-select">
                                        <option value="">Pilih Bandara Keberangkatan</option>
                                        @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->id_bandara }}" {{ request('from') == $bandara->id_bandara ? 'selected' : '' }}>
                                            {{ $bandara->nama_bandara }} - {{ $bandara->kota }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ke</label>
                                    <select name="to" class="form-select">
                                        <option value="">Pilih Bandara Tujuan</option>
                                        @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->id_bandara }}" {{ request('to') == $bandara->id_bandara ? 'selected' : '' }}>
                                            {{ $bandara->nama_bandara }} - {{ $bandara->kota }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Tanggal</label>
                                    <input type="date" name="date" value="{{ request('date') }}" class="form-control">
                                </div>
                                <div class="col-md-3 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Hasil Pencarian -->
                @if(request('from') || request('to') || request('date'))
                <div class="mb-3">
                    <h6 class="text-muted">
                        Hasil Pencarian: {{ $jadwals->count() }} penerbangan ditemukan
                    </h6>
                </div>
                @endif

                <!-- Ticket List -->
                <div class="row g-3">
                    @forelse($jadwals as $jadwal)
                    @php
                        // Hitung jumlah kursi yang tersedia
                        $totalSeats = \App\Models\Seat::where('id_pesawat', $jadwal->id_pesawat)->count();
                        $bookedSeats = \App\Models\Pemesanan::where('no_penerbangan', $jadwal->no_penerbangan)->count();
                        $availableSeats = $totalSeats - $bookedSeats;
                    @endphp
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <!-- Airline Info & Price -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary bg-gradient p-2 rounded-3 me-2">
                                            <i class="fas fa-plane text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $jadwal->maskapai->nama_maskapai }}</h6>
                                            <small class="text-muted">{{ $jadwal->no_penerbangan }}</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-muted d-block">Dari</small>
                                        <span class="text-primary fw-bold">Rp {{ number_format($jadwal->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Tanggal Penerbangan -->
                                <div class="mb-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>
                                        <div>
                                            <small class="text-muted">Tanggal Penerbangan</small>
                                            <h6 class="mb-0">{{ \Carbon\Carbon::parse($jadwal->date)->format('d M Y') }}</h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Flight Route -->
                                <div class="row align-items-center g-0 mb-3">
                                    <div class="col text-center">
                                        <h6 class="mb-1">{{ $jadwal->bandaraKeberangkatan->kode_bandara }}</h6>
                                        <small class="text-muted d-block">{{ $jadwal->bandaraKeberangkatan->nama_bandara }}</small>
                                        <small class="text-muted d-block">{{ $jadwal->bandaraKeberangkatan->kota }}</small>
                                        <small class="fw-bold">{{ \Carbon\Carbon::parse($jadwal->boarding_time)->format('H:i') }}</small>
                                    </div>
                                    <div class="col-4 text-center">
                                        <div class="position-relative">
                                            <hr class="m-0">
                                            <i class="fas fa-plane text-primary position-absolute top-50 start-50 translate-middle"></i>
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <h6 class="mb-1">{{ $jadwal->bandaraTujuan->kode_bandara }}</h6>
                                        <small class="text-muted d-block">{{ $jadwal->bandaraTujuan->nama_bandara }}</small>
                                        <small class="text-muted d-block">{{ $jadwal->bandaraTujuan->kota }}</small>
                                        <small class="fw-bold">-</small>
                                    </div>
                                </div>

                                <!-- Additional Info & Action Button -->
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <div>
                                        <small class="text-muted">
                                            <i class="fas fa-door-open text-primary me-1"></i>
                                            <span class="fw-bold">Gerbang</span> {{ $jadwal->gerbang }}
                                        </small>
                                        <small class="text-muted ms-3">
                                            @if($availableSeats > 0)
                                                <span class="badge bg-success">
                                                    <i class="fas fa-chair me-1"></i>
                                                    {{ $availableSeats }} Kursi Tersedia
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fas fa-times-circle me-1"></i>
                                                    Kursi Habis
                                                </span>
                                            @endif
                                        </small>
                                    </div>
                                    <a href="{{ route('pemesanan.create', $jadwal->no_penerbangan) }}" 
                                       class="btn btn-sm btn-primary">
                                        Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body text-center py-5">
                                <i class="fas fa-plane-slash fs-1 text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada penerbangan yang ditemukan</h5>
                                <p class="text-muted small">Silakan coba dengan kriteria pencarian yang berbeda</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

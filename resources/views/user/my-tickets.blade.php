<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tiket Saya') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($tickets->isEmpty())
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Anda belum memiliki tiket. <a href="{{ route('tiket.list') }}" class="alert-link">Pesan tiket sekarang!</a>
            </div>
        @else
        <div class="row justify-content-center"> <!-- Tambahkan row -->
            @foreach($tickets as $no_pemesanan => $pesananGroup)
                @php
                    $firstPesanan = $pesananGroup->first();
                    $allSeats = $pesananGroup->pluck('bangku_code')->implode(', ');
                @endphp
                <div class="card mb-4 shadow-sm col-lg-5 col-md-8 mx-2 d-flex mb-4">
                    <div class="card-header bg-primary text-white py-3 h">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-ticket-alt me-2"></i>
                                <span class="fw-bold">Nomor Pemesanan: {{ $no_pemesanan }}</span>
                            </div>
                            <div>
                                <span class="badge bg-{{ $firstPesanan->status_pesanan === 'Pending' ? 'warning' :
                                    ($firstPesanan->status_pesanan === 'Confirmed' ? 'success' : 'danger') }} px-3 py-2">
                                    <i class="fas fa-{{ $firstPesanan->status_pesanan === 'Pending' ? 'clock' :
                                        ($firstPesanan->status_pesanan === 'Confirmed' ? 'check' : 'times') }} me-1"></i>
                                    {{ $firstPesanan->status_pesanan }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-plane text-primary me-2"></i>
                                    <h5 class="mb-0">Detail Penerbangan</h5>
                                </div>
                                <div class="ps-4">
                                    <p class="mb-2"><strong>No. Penerbangan:</strong> {{ $firstPesanan->no_penerbangan }}</p>
                                    <p class="mb-2"><strong>Maskapai:</strong> {{ $firstPesanan->jadwal->maskapai->nama_maskapai }}</p>
                                    <p class="mb-0"><strong>Pesawat:</strong> {{ $firstPesanan->jadwal->maskapai->nama_pesawat }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <h5 class="mb-0">Rute Penerbangan</h5>
                                </div>
                                <div class="ps-4">
                                    <p class="mb-2">
                                        <strong>Dari:</strong> {{ $firstPesanan->jadwal->bandaraKeberangkatan->nama_bandara }}
                                        <small class="text-muted">({{ $firstPesanan->jadwal->bandaraKeberangkatan->kota }})</small>
                                    </p>
                                    <p class="mb-0">
                                        <strong>Ke:</strong> {{ $firstPesanan->jadwal->bandaraTujuan->nama_bandara }}
                                        <small class="text-muted">({{ $firstPesanan->jadwal->bandaraTujuan->kota }})</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-clock text-primary me-2"></i>
                                    <h5 class="mb-0">Waktu Penerbangan</h5>
                                </div>
                                <div class="ps-4">
                                    <p class="mb-2"><strong>Tanggal:</strong> {{ date('d M Y', strtotime($firstPesanan->jadwal->date)) }}</p>
                                    <p class="mb-2"><strong>Boarding:</strong> {{ date('H:i', strtotime($firstPesanan->jadwal->boarding_time)) }}</p>
                                    <p class="mb-0"><strong>Gate:</strong> {{ $firstPesanan->jadwal->gerbang }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-chair text-primary me-2"></i>
                                    <h5 class="mb-0">Informasi Kursi</h5>
                                </div>
                                <div class="ps-4">
                                    <p class="mb-0">
                                        <strong>Nomor Kursi:</strong><br>
                                        @foreach(explode(', ', $allSeats) as $bangku)
                                            <span class="badge bg-info me-1 px-3 py-2 my-1">{{ $bangku }}</span>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-money-bill text-primary me-2"></i>
                                    <h5 class="mb-0">Informasi Pembayaran</h5>
                                </div>
                                <div class="ps-4">
                                    <p class="mb-2"><strong>Metode Pembayaran:</strong> {{ $firstPesanan->pembayaran }}</p>
                                    <p class="mb-2"><strong>Total Harga:</strong>
                                        <span class="text-primary fw-bold">
                                            Rp {{ number_format($firstPesanan->total_harga, 0, ',', '.') }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>
</x-app-layout>

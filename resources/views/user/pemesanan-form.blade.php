<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Form Pemesanan Tiket
        </h2>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Detail Penerbangan -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Detail Penerbangan</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <small class="text-muted">No. Penerbangan</small>
                            <p class="font-weight-bold">{{ $jadwal->no_penerbangan }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Maskapai</small>
                            <p class="font-weight-bold">{{ $jadwal->maskapai->nama_maskapai }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Dari</small>
                            <p class="font-weight-bold">{{ $jadwal->bandaraKeberangkatan->nama_bandara }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Ke</small>
                            <p class="font-weight-bold">{{ $jadwal->bandaraTujuan->nama_bandara }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Tanggal</small>
                            <p class="font-weight-bold">{{ \Carbon\Carbon::parse($jadwal->date)->format('d M Y') }}</p>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">Waktu Boarding</small>
                            <p class="font-weight-bold">{{ $jadwal->boarding_time }}</p>
                        </div>

                        <!-- Ringkasan Pemesanan -->
                        <div class="border-top pt-3">
                            <h6 class="mb-3">Ringkasan Pemesanan</h6>
                            <div id="selectedSeats" class="mb-3">
                                <small class="text-muted">Kursi Dipilih:</small>
                                <p id="selectedSeatsText" class="font-weight-bold">-</p>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted">Total Pembayaran:</small>
                                <p id="totalPayment" class="font-weight-bold text-primary">Rp 0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pemilihan Kursi -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Pilih Kursi</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data" id="bookingForm">
                            @csrf
                            <input type="hidden" name="no_penerbangan" value="{{ $jadwal->no_penerbangan }}">

                            <!-- Legenda Status Kursi -->
                            <div class="mb-4 d-flex gap-4">
                                <div class="d-flex align-items-center">
                                    <div class="seat-available me-2"></div>
                                    <small>Tersedia</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="seat-selected me-2"></div>
                                    <small>Dipilih</small>
                                </div>
                            </div>

                            <!-- Denah Kursi -->
                            <div class="seat-map mb-4">
                                <div class="seats-container">
                                    @php
                                        // Pastikan kursi_perbaris tidak 0
                                        $kursi_per_baris = $jadwal->maskapai->kursi_perbaris ?? 6; // Default 6 jika null
                                        $total_kursi = count($seats);
                                        $total_baris = $total_kursi > 0 ? ceil($total_kursi / $kursi_per_baris) : 0;
                                    @endphp

                                    @for ($baris = 1; $baris <= $total_baris; $baris++)
                                        <div class="seat-row">
                                            @for ($kolom = 1; $kolom <= $kursi_per_baris; $kolom++)
                                                @php
                                                    $kode_kursi = $baris . chr(64 + $kolom);
                                                    $kursi = $seats->where('bangku_code', $kode_kursi)->first();
                                                @endphp

                                                @if($kursi)
                                                    <div class="seat-item">
                                                        <input type="checkbox"
                                                               name="bangku_code[]"
                                                               value="{{ $kursi->bangku_code }}"
                                                               id="seat-{{ $kursi->bangku_code }}"
                                                               class="seat-checkbox">
                                                        <label for="seat-{{ $kursi->bangku_code }}"
                                                               class="seat-label">
                                                            {{ $kursi->bangku_code }}
                                                        </label>
                                                    </div>
                                                @else
                                                    <div class="seat-item seat-empty"></div>
                                                @endif
                                            @endfor
                                        </div>
                                    @endfor
                                </div>
                            </div>

                            <!-- Sebelum Upload Bukti Pembayaran -->
                            <div class="mb-4">
                                <label class="form-label">Metode Pembayaran</label>
                                <select name="pembayaran" class="form-control" required>
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <option value="DANA">DANA</option>
                                    <option value="OVO">OVO</option>
                                    <option value="GoPay">GoPay</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                </select>

                                <!-- Informasi Rekening/Pembayaran -->
                                <div class="mt-2 payment-info" style="display: none;">
                                    <div class="alert alert-info">
                                        <div class="dana-info" style="display: none;">
                                            <p class="mb-1"><strong>DANA</strong></p>
                                            <p class="mb-0">No. DANA: 085123456789</p>
                                            <p class="mb-0">a.n. Nama Perusahaan</p>
                                        </div>
                                        <div class="ovo-info" style="display: none;">
                                            <p class="mb-1"><strong>OVO</strong></p>
                                            <p class="mb-0">No. OVO: 085123456789</p>
                                            <p class="mb-0">a.n. Nama Perusahaan</p>
                                        </div>
                                        <div class="gopay-info" style="display: none;">
                                            <p class="mb-1"><strong>GoPay</strong></p>
                                            <p class="mb-0">No. GoPay: 085123456789</p>
                                            <p class="mb-0">a.n. Nama Perusahaan</p>
                                        </div>
                                        <div class="bank-info" style="display: none;">
                                            <p class="mb-1"><strong>Bank Transfer</strong></p>
                                            <p class="mb-0">Bank BCA: 1234567890</p>
                                            <p class="mb-0">a.n. Nama Perusahaan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Bukti Pembayaran -->
                            <div class="mb-4">
                                <label class="form-label">Bukti Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" class="form-control" required>
                                <small class="text-muted">Upload bukti pembayaran sesuai dengan metode pembayaran yang dipilih</small>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">
                                    Pesan Tiket
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS untuk Denah Kursi -->
    <style>
        .seat-map {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
        }

        .seats-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .seat-row {
            display: flex;
            gap: 1rem;
        }

        .seat-item {
            position: relative;
            width: 40px;
            height: 40px;
        }

        .seat-checkbox {
            display: none;
        }

        .seat-label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: #5e72e4;
            color: white;
            border-radius: 0.5rem;
            cursor: pointer;
            font-size: 0.8rem;
            transition: all 0.2s;
        }

        .seat-checkbox:checked + .seat-label {
            background: #2dce89;
        }

        .seat-empty {
            visibility: hidden;
        }

        /* Legenda */
        .seat-available,
        .seat-selected,
        .seat-booked {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .seat-available {
            background: #5e72e4;
        }

        .seat-selected {
            background: #2dce89;
        }

        .seat-booked {
            background: #f5365c;
        }
    </style>

    <!-- JavaScript untuk Interaksi -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('bookingForm');
            const checkboxes = document.querySelectorAll('.seat-checkbox');
            const selectedSeatsText = document.getElementById('selectedSeatsText');
            const totalPayment = document.getElementById('totalPayment');
            const pricePerSeat = {{ $jadwal->harga }};

            function updateSummary() {
                const selectedSeats = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.value);

                selectedSeatsText.textContent = selectedSeats.length > 0
                    ? selectedSeats.join(', ')
                    : '-';

                const total = selectedSeats.length * pricePerSeat;
                totalPayment.textContent = `Rp ${total.toLocaleString('id-ID')}`;
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateSummary);
            });

            form.addEventListener('submit', function(e) {
                const selectedSeats = Array.from(checkboxes)
                    .filter(cb => cb.checked);

                if (selectedSeats.length === 0) {
                    e.preventDefault();
                    alert('Silakan pilih minimal satu kursi');
                }
            });
        });

        // Script untuk menampilkan informasi pembayaran
        document.querySelector('select[name="pembayaran"]').addEventListener('change', function() {
            const paymentInfo = document.querySelector('.payment-info');
            const danaInfo = document.querySelector('.dana-info');
            const ovoInfo = document.querySelector('.ovo-info');
            const gopayInfo = document.querySelector('.gopay-info');
            const bankInfo = document.querySelector('.bank-info');

            // Sembunyikan semua info pembayaran
            danaInfo.style.display = 'none';
            ovoInfo.style.display = 'none';
            gopayInfo.style.display = 'none';
            bankInfo.style.display = 'none';

            // Tampilkan info sesuai metode yang dipilih
            if (this.value) {
                paymentInfo.style.display = 'block';
                switch(this.value) {
                    case 'DANA':
                        danaInfo.style.display = 'block';
                        break;
                    case 'OVO':
                        ovoInfo.style.display = 'block';
                        break;
                    case 'GoPay':
                        gopayInfo.style.display = 'block';
                        break;
                    case 'Bank Transfer':
                        bankInfo.style.display = 'block';
                        break;
                }
            } else {
                paymentInfo.style.display = 'none';
            }
        });
    </script>
</x-app-layout>

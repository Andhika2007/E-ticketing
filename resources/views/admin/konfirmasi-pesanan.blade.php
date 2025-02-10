<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pesanan') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        @if ($pesanans->isEmpty())
            <div class="alert alert-info">
                Tidak ada pesanan yang perlu dikonfirmasi.
            </div>
        @else
            @foreach ($pesanans as $no_pemesanan => $pesananGroup)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Nomor Pemesanan: {{ $no_pemesanan }}</span>
                            <span
                                class="badge bg-{{ $pesananGroup->first()->status_pesanan === 'Pending'
                                    ? 'warning'
                                    : ($pesananGroup->first()->status_pesanan === 'Confirmed'
                                        ? 'success'
                                        : 'danger') }}">
                                {{ $pesananGroup->first()->status_pesanan }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach ($pesananGroup as $pesanan)
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <h5>Detail Penumpang</h5>
                                    <p>Nama: {{ $pesanan->user->name }}</p>
                                    <p>Email: {{ $pesanan->user->email }}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5>Detail Penerbangan</h5>
                                    <p>No. Penerbangan: {{ $pesanan->no_penerbangan }}</p>
                                    <p>Kursi: {{ $pesanan->bangku_code }}</p>
                                </div>
                                <div class="col-md-3">
                                    <h5>Pembayaran</h5>
                                    <p>Metode: {{ $pesanan->pembayaran }}</p>
                                    <p>
                                        <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            Lihat Bukti
                                        </a>
                                    </p>
                                </div>
                                <div class="col-md-3">
                                    <h5>Status</h5>
                                    <form action="{{ route('konfirmasi.update') }}" class="status-form"
                                        data-pemesanan-id="{{ $pesanan->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="id" value="{{ $pesanan->id }}" />
                                        <select class="form-select status-select" name="status_pesanan"
                                            {{ $pesanan->status_pesanan !== 'Pending' ? 'disabled' : '' }}>
                                            <option value="Pending"
                                                {{ $pesanan->status_pesanan === 'Pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="Confirmed"
                                                {{ $pesanan->status_pesanan === 'Confirmed' ? 'selected' : '' }}>
                                                Confirmed
                                            </option>
                                            <option value="Cancelled"
                                                {{ $pesanan->status_pesanan === 'Cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>
                                        @if ($pesanan->status_pesanan !== 'Confirmed')
                                            <button type="submit" class="btn btn-primary btn-sm mt-2">
                                                Update Status
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.status-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const pemesananId = this.dataset.pemesananId;
                    const select = this.querySelector('.status-select');
                    const status = select.value;

                    if (confirm('Apakah Anda yakin ingin mengubah status menjadi ' + status + '?')) {
                        fetch(`/konfirmasi-pesanan/${pemesananId}`, {
                                method: 'PATCH',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Accept': 'application/json'
                                },
                                body: JSON.stringify({
                                    status_pesanan: status
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert('Status berhasil diperbarui');
                                    window.location.reload();
                                } else {
                                    alert(data.message || 'Gagal mengupdate status');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan saat mengupdate status');
                            });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>

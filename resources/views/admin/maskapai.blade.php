<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($maskapai) ? 'Edit Pesawat' : 'Tambah Pesawat' }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <!-- Form Tambah/Edit Pesawat -->
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ isset($maskapai) ? 'Edit Maskapai' : 'Tambah Maskapai' }}</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ isset($maskapai->id) ? route('maskapai.update', $maskapai->id) : route('maskapai.store') }}" method="POST">
                            @csrf
                            @if(isset($maskapai->id))
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="id_pesawat" class="form-label">ID Pesawat</label>
                                <input type="text" class="form-control" name="id_pesawat"
                                    value="{{ old('id_pesawat', $maskapai->id_pesawat ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama_maskapai" class="form-label">Nama Maskapai</label>
                                <input type="text" class="form-control" name="nama_maskapai"
                                    value="{{ old('nama_maskapai', $maskapai->nama_maskapai ?? '') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="nama_pesawat" class="form-label">Nama Pesawat</label>
                                <input type="text" class="form-control" name="nama_pesawat"
                                    value="{{ old('nama_pesawat', $maskapai->nama_pesawat ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_pesawat" class="form-label">jenis Pesawat</label>
                                <input type="text" class="form-control" name="jenis_pesawat"
                                    value="{{ old('jenis_pesawat', $maskapai->jenis_pesawat ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_kursi" class="form-label">Jumlah Bangku</label>
                                <input type="number" class="form-control" name="jumlah_kursi"
                                    value="{{ old('jumlah_kursi', $maskapai->jumlah_kursi ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="kursi_perbaris" class="form-label">Kursi Per Baris</label>
                                <input type="number" class="form-control" name="kursi_perbaris"
                                    value="{{ old('kursi_perbaris', $maskapai->kursi_perbaris ?? '') }}" required>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($maskapai->id) ? 'Simpan Perubahan' : 'Tambah' }}
                                </button>
                                @if(isset($maskapai->id))
                                    <a href="{{ route('maskapai.index') }}" class="btn btn-secondary">Batal</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <!-- Daftar Pesawat -->
                <div class="card">
                    <div class="card-header bg-success text-white">Daftar Pesawat</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID Pesawat</th>
                                        <th>Maskapai</th>
                                        <th>Nama Pesawat</th>
                                        <th>Jenis Pesawat</th>
                                        <th>Jumlah Bangku</th>
                                        <th>Kursi Perbaris</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($maskapais as $item)
                                    <tr>
                                        <td>{{ $item->id_pesawat }}</td>
                                        <td>{{ $item->nama_maskapai }}</td>
                                        <td>{{ $item->nama_pesawat }}</td>
                                        <td>{{ $item->jenis_pesawat }}</td>
                                        <td>{{ $item->jumlah_kursi }}</td>
                                        <td>{{ $item->kursi_perbaris }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('maskapai.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('maskapai.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

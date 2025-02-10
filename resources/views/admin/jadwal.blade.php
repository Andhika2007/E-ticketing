<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($jadwal) ? 'Edit Jadwal Penerbangan' : 'Tambah Jadwal Penerbangan' }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <!-- Form Tambah/Edit Pesawat -->
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ isset($jadwal) ? 'Edit Jadwal Penerbangan' : 'Tambah Jadwal Penerbangan' }}</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ isset($jadwal->id) ? route('jadwal.update', $jadwal->id) : route('jadwal.store') }}" method="POST">
                            @csrf
                            @if(isset($jadwal->id))
                                @method('PUT')
                            @endif
                            <div class="mb-3">
                                <label for="no_penerbangan" class="form-label">No Penerbangan</label>
                                <input type="text" class="form-control" name="no_penerbangan"
                                    value="{{ old('no_penerbangan', $jadwal->no_penerbangan ?? '') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_pesawat" class="form-label">Pesawat</label>
                                <select class="form-control" name="id_pesawat" required>
                                    <option value="">Pilih Pesawat</option>
                                    @foreach($maskapais as $pesawat)
                                        <option value="{{ $pesawat->id_pesawat }}"
                                            {{ (isset($jadwal) && $jadwal->id_pesawat == $pesawat->id_pesawat) || old('id_pesawat') == $pesawat->id_pesawat ? 'selected' : '' }}>
                                            {{ $pesawat->nama_pesawat }} - {{ $pesawat->nama_maskapai }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="keberangkatan" class="form-label">Berangkat dari</label>
                                <select class="form-control" name="keberangkatan" id="keberangkatan" required>
                                    <option value="">Pilih keberangkatan</option>
                                    @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->id_bandara }}"
                                            {{ (isset($jadwal) && $jadwal->keberangkatan == $bandara->id_bandara) || old('keberangkatan') == $bandara->bandara_id ? 'selected' : '' }}>
                                            {{ $bandara->nama_bandara }} - {{ $bandara->kota }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">tujuan</label>
                                <select class="form-control" name="tujuan" id="tujuan" required>
                                    <option value="">Pilih tujuan</option>
                                    @foreach($bandaras as $bandara)
                                        <option value="{{ $bandara->id_bandara }}"
                                            {{ (isset($jadwal) && $jadwal->tujuan == $bandara->id_bandara) || old('tujuan') == $bandara->bandara_id ? 'selected' : '' }}>
                                            {{ $bandara->nama_bandara }} - {{ $bandara->kota }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal Berangkat</label>
                                <input type="date" class="form-control" name="date"
                                    value="{{ old('date', isset($jadwal) ? date('Y-m-d', strtotime($jadwal->date)) : '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="boarding_time" class="form-label">Boarding Time</label>
                                <input type="time" class="form-control" name="boarding_time"
                                    value="{{ old('boarding_time', isset($jadwal) ? date('H:i', strtotime($jadwal->boarding_time)) : '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="gerbang" class="form-label">gerbang</label>
                                <input type="text" class="form-control" name="gerbang"
                                    value="{{ old('gerbang', $jadwal->gerbang ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control" name="harga"
                                    value="{{ old('harga', $jadwal->harga ?? '') }}">
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($jadwal->id) ? 'Simpan Perubahan' : 'Tambah' }}
                                </button>
                                @if(isset($jadwal->id))
                                    <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8">
                <!-- Daftar Pesawat -->
                <div class="card">
                    <div class="card-header bg-success text-white">Jadwal Penerbangan</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No Penerbangan</th>
                                        <th>Pesawat</th>
                                        <th>Berangkat dari</th>
                                        <th>Tujuan</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Boarding Time</th>
                                        <th>gerbang Bandara</th>
                                        <th>Harga Tiket</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jadwals as $item)
                                    <tr>
                                        <td>{{ $item->no_penerbangan }}</td>
                                        <td>{{ $item->maskapai->nama_pesawat }}</td>
                                        <td>{{ $item->bandaraKeberangkatan->nama_bandara }}</td>
                                        <td>{{ $item->bandaraTujuan->nama_bandara }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>{{ $item->boarding_time }}</td>
                                        <td>{{ $item->gerbang }}</td>
                                        <td>{{ $item->harga }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('jadwal.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" style="display:inline;">
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

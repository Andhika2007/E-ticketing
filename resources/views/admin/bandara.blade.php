<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($bandara) ? 'Edit Pesawat' : 'Tambah Pesawat' }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <!-- Form Tambah/Edit Bandara -->
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ isset($bandara) ? 'Edit Bandara' : 'Tambah Bandara' }}</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ isset($bandara->id) ? route('bandara.update', $bandara->id) : route('bandara.store') }}" method="POST">
                            @csrf
                            @if(isset($bandara->id))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="id_bandara" class="form-label">ID Bandara</label>
                                <input type="text" class="form-control @error('id_bandara') is-invalid @enderror" 
                                    name="id_bandara" value="{{ old('id_bandara', $bandara->id_bandara ?? '') }}" required>
                                @error('id_bandara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nama_bandara" class="form-label">Nama Bandara</label>
                                <input type="text" class="form-control @error('nama_bandara') is-invalid @enderror" 
                                    name="nama_bandara" value="{{ old('nama_bandara', $bandara->nama_bandara ?? '') }}" required>
                                @error('nama_bandara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" class="form-control @error('kota') is-invalid @enderror" 
                                    name="kota" value="{{ old('kota', $bandara->kota ?? '') }}" required>
                                @error('kota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="negara" class="form-label">Negara</label>
                                <input type="text" class="form-control @error('negara') is-invalid @enderror" 
                                    name="negara" value="{{ old('negara', $bandara->negara ?? '') }}" required>
                                @error('negara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex flex-column gap-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($bandara->id) ? 'Simpan Perubahan' : 'Tambah' }}
                                </button>
                                @if(isset($bandara->id))
                                    <a href="{{ route('bandara.index') }}" class="btn btn-secondary">Batal</a>
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
                                        <th>ID Bandara</th>
                                        <th>Nama Bandara</th>
                                        <th>Kota</th>
                                        <th>Negara</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bandaras as $item)
                                    <tr>
                                        <td>{{ $item->id_bandara }}</td>
                                        <td>{{ $item->nama_bandara }}</td>
                                        <td>{{ $item->kota }}</td>
                                        <td>{{ $item->negara }}</td>
                                        <td>
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('bandara.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('bandara.destroy', $item->id) }}" method="POST" style="display:inline;">
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

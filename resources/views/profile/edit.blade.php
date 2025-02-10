<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container-fluid py-4">
        <div class="row">
            <!-- Informasi Profil -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Profile</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">Nama</label>
                                        <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                                        @error('name')
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">Email</label>
                                        <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Update Password -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Update Password</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <label for="current_password" class="form-control-label">Password Saat Ini</label>
                                <input class="form-control" type="password" id="current_password" name="current_password" required>
                                @error('current_password')
                                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password" class="form-control-label">Password Baru</label>
                                <input class="form-control" type="password" id="password" name="password" required>
                                @error('password')
                                    <p class="text-danger text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">Konfirmasi Password</label>
                                <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary btn-sm ms-auto">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Hapus Akun -->
                <div class="card mt-4">
                    <div class="card-header pb-0 bg-danger">
                        <div class="d-flex align-items-center">
                            <p class="mb-0 text-white">Hapus Akun</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-sm mb-3">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen.</p>
                        
                        <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun?');">
                            @csrf
                            @method('delete')

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus Akun
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if(session('status') === 'profile-updated')
            <div class="position-fixed bottom-1 end-1 z-index-2">
                <div class="toast fade show p-2 bg-white" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header border-0">
                        <i class="ni ni-check-bold text-success me-2"></i>
                        <span class="me-auto font-weight-bold">Success</span>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        Profile berhasil diperbarui!
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        // Auto hide toast after 3 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const toast = document.querySelector('.toast');
            if (toast) {
                setTimeout(function() {
                    toast.classList.remove('show');
                }, 3000);
            }
        });
    </script>
    @endpush
</x-app-layout>

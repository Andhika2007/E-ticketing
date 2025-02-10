<x-guest-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-white shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h3 class="font-weight-light my-2">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </h3>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" name="name" 
                                    value="{{ old('name') }}" required autofocus 
                                    placeholder="Enter your name" />
                                <label for="name">Full Name</label>
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>

                            <!-- Email Address -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" name="email" 
                                    value="{{ old('email') }}" required 
                                    placeholder="name@example.com" />
                                <label for="email">Email address</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <!-- Password -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" type="password" 
                                    name="password" required placeholder="Create a password" />
                                <label for="password">Password</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password_confirmation" 
                                    type="password" name="password_confirmation" required 
                                    placeholder="Confirm password" />
                                <label for="password_confirmation">Confirm Password</label>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                            </div>

                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small text-decoration-none" href="{{ route('login') }}">
                                    Already have an account? Login!
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-user-plus me-2"></i>Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
                        url('/assets/img/hero-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
        }

        .form-floating > label {
            left: 1rem;
        }

        .card {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.9);
        }

        .btn-primary {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-guest-layout>

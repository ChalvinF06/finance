@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-wallet fa-3x text-primary"></i>
                    <h3 class="mt-3">Login</h3>
                    <p class="text-muted">Aplikasi Keuangan Pribadi</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>

                <div class="mt-4 text-center">
                    <small class="text-muted">
                        <strong>Demo Account:</strong><br>
                        Username: chalvin, Password: 210203<br>
                        Username: ajian_sakti, Password: matahari
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
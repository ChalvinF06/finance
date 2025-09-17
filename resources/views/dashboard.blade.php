@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Dashboard</h2>
        <p class="text-muted">Selamat datang, <strong>{{ session('username') }}</strong>!</p>
    </div>
</div>

<!-- Total Kekayaan -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white {{ $totalWealth >= 0 ? 'bg-success' : 'bg-danger' }}">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title">Total Kekayaan</h6>
                        <h3 class="mb-0">Rp {{ number_format($totalWealth, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="fas fa-coins fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title">Pemasukan Minggu Ini</h6>
                        <h3 class="mb-0">Rp {{ number_format($weeklyIncome, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="fas fa-arrow-up fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="card-title">Pengeluaran Minggu Ini</h6>
                        <h3 class="mb-0">Rp {{ number_format($weeklyExpense, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex-shrink-0">
                        <i class="fas fa-arrow-down fa-2x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Transaksi -->
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Pemasukan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('transaction.add') }}">
                    @csrf
                    <input type="hidden" name="type" value="income">
                    
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="amount" class="form-control" step="0.01" min="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="description" class="form-control" rows="2" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-save"></i> Tambah Pemasukan
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="fas fa-minus-circle"></i> Tambah Pengeluaran</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('transaction.add') }}">
                    @csrf
                    <input type="hidden" name="type" value="expense">
                    
                    <div class="mb-3">
                        <label class="form-label">Jumlah</label>
                        <input type="number" name="amount" class="form-control" step="0.01" min="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea name="description" class="form-control" rows="2" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-save"></i> Tambah Pengeluaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
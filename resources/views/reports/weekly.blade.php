@extends('layouts.app')

@section('title', 'Laporan Mingguan')

@section('content')
<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Laporan Mingguan</h2>
        <p class="text-muted">Periode: {{ \Carbon\Carbon::now()->startOfWeek()->format('d M Y') }} - {{ \Carbon\Carbon::now()->endOfWeek()->format('d M Y') }}</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body text-center">
                <h6>Total Pemasukan Mingguan</h6>
                <h3>Rp {{ number_format($totalWeeklyIncome, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body text-center">
                <h6>Total Pengeluaran Mingguan</h6>
                <h3>Rp {{ number_format($totalWeeklyExpense, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white {{ ($totalWeeklyIncome - $totalWeeklyExpense) >= 0 ? 'bg-success' : 'bg-danger' }}">
            <div class="card-body text-center">
                <h6>Selisih Mingguan</h6>
                <h3>Rp {{ number_format($totalWeeklyIncome - $totalWeeklyExpense, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pemasukan Mingguan -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-arrow-up"></i> Pemasukan Minggu Ini ({{ $weeklyIncomes->count() }} transaksi)</h5>
            </div>
            <div class="card-body">
                @if($weeklyIncomes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weeklyIncomes as $income)
                                <tr>
                                    <td>{{ $income->date->format('d/m/Y') }}</td>
                                    <td>{{ $income->description }}</td>
                                    <td class="text-end text-success">
                                        <strong>+Rp {{ number_format($income->amount, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p>Belum ada pemasukan minggu ini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Pengeluaran Mingguan -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="fas fa-arrow-down"></i> Pengeluaran Minggu Ini ({{ $weeklyExpenses->count() }} transaksi)</h5>
            </div>
            <div class="card-body">
                @if($weeklyExpenses->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weeklyExpenses as $expense)
                                <tr>
                                    <td>{{ $expense->date->format('d/m/Y') }}</td>
                                    <td>{{ $expense->description }}</td>
                                    <td class="text-end text-danger">
                                        <strong>-Rp {{ number_format($expense->amount, 0, ',', '.') }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-inbox fa-2x mb-2"></i>
                        <p>Belum ada pengeluaran minggu ini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
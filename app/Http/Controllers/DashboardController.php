<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $username = session('username');
        
        // Calculate total wealth
        $totalIncome = Transaction::forUser($username)->income()->sum('amount');
        $totalExpense = Transaction::forUser($username)->expense()->sum('amount');
        $totalWealth = $totalIncome - $totalExpense;

        // Weekly summary
        $weeklyIncome = Transaction::forUser($username)->income()->thisWeek()->sum('amount');
        $weeklyExpense = Transaction::forUser($username)->expense()->thisWeek()->sum('amount');

        return view('dashboard', compact('totalWealth', 'weeklyIncome', 'weeklyExpense'));
    }

    public function addTransaction(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0.01',
            'description' => 'required|string|max:255',
            'date' => 'required|date'
        ]);

        Transaction::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
            'username' => session('username')
        ]);

        $message = $request->type === 'income' ? 'Pemasukan berhasil ditambahkan!' : 'Pengeluaran berhasil ditambahkan!';
        return redirect()->route('dashboard')->with('success', $message);
    }
}
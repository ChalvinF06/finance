<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function weekly()
    {
        $username = session('username');
        
        $weeklyIncomes = Transaction::forUser($username)
            ->income()
            ->thisWeek()
            ->orderBy('date', 'desc')
            ->get();

        $weeklyExpenses = Transaction::forUser($username)
            ->expense()
            ->thisWeek()
            ->orderBy('date', 'desc')
            ->get();

        $totalWeeklyIncome = $weeklyIncomes->sum('amount');
        $totalWeeklyExpense = $weeklyExpenses->sum('amount');

        return view('reports.weekly', compact(
            'weeklyIncomes', 
            'weeklyExpenses', 
            'totalWeeklyIncome', 
            'totalWeeklyExpense'
        ));
    }
}
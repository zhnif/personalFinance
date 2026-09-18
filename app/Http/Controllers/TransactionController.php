<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

//newCode: Summary
public function summary()
{
    $totalIncome = Transaction::where('type', 'income')->sum('amount');
    $totalExpense = Transaction::where('type', 'expense')->sum('amount');
    $balance = $totalIncome - $totalExpense;

    $incomeCount = Transaction::where('type', 'income')->count();
    $expenseCount = Transaction::where('type', 'expense')->count();
    $transactionCount = Transaction::count();

    $categorySummary = Transaction::selectRaw(
        'category, type, SUM(amount) as total'
    )
        ->groupBy('category', 'type')
        ->orderByDesc('total')
        ->get();

    $expenseCategories = $categorySummary
        ->where('type', 'expense');

    $largestExpenseCategory = $expenseCategories->first();

    $categoryCount = Transaction::select('category')
        ->distinct()
        ->count();

    $incomePercentage = $totalIncome > 0
        ? ($totalIncome / ($totalIncome + $totalExpense)) * 100
        : 0;

    $expensePercentage = $totalExpense > 0
        ? ($totalExpense / ($totalIncome + $totalExpense)) * 100
        : 0;

    return view('summary.index', compact(
        'totalIncome',
        'totalExpense',
        'balance',
        'incomeCount',
        'expenseCount',
        'transactionCount',
        'categorySummary',
        'largestExpenseCategory',
        'categoryCount',
        'incomePercentage',
        'expensePercentage'
    ));
}

//newCode: Home Dashboard
public function home()
{
    $transactions = Transaction::latest('transaction_date')
        ->get();

    $totalIncome = Transaction::where('type', 'income')
        ->sum('amount');

    $totalExpense = Transaction::where('type', 'expense')
        ->sum('amount');

    $balance = $totalIncome - $totalExpense;

    return view('home.index', compact(
        'transactions',
        'totalIncome',
        'totalExpense',
        'balance'
    ));
}

    public function index(Request $request)
    {
        $query = Transaction::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('start_date')) {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }

        //newCode
        $transactions = $query
            ->latest('transaction_date')
            ->paginate(10)
            ->withQueryString();

        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('transactions.index', compact(
            'transactions',
            'totalIncome',
            'totalExpense',
            'balance'
        ));
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:100',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        Transaction::create($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:100',
            'transaction_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}

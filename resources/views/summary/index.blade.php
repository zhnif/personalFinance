@extends('layouts.app')

@section('title', 'Summary')

@section('content')

<div class="summary-page">

    <div class="page-header">
        <div>
            <span class="page-label">OVERVIEW</span>
            <h1>Summary</h1>
            <p>Ringkasan kondisi keuangan kamu.</p>
        </div>
    </div>

    {{-- //newCode: Balance --}}
    <div class="summary-balance-card">
        <div>
            <span>Total Saldo</span>
            <h2>
                Rp {{ number_format($balance, 0, ',', '.') }}
            </h2>
        </div>

        <div class="summary-balance-icon">
            ◔
        </div>
    </div>

    {{-- //newCode: Income Expense --}}
    <div class="summary-stat-grid">

        <div class="summary-stat-card income">
            <span>Total Pemasukan</span>

            <strong>
                Rp {{ number_format($totalIncome, 0, ',', '.') }}
            </strong>

            <small>
                {{ $incomeCount }} transaksi
            </small>
        </div>

        <div class="summary-stat-card expense">
            <span>Total Pengeluaran</span>

            <strong>
                Rp {{ number_format($totalExpense, 0, ',', '.') }}
            </strong>

            <small>
                {{ $expenseCount }} transaksi
            </small>
        </div>

    </div>

{{-- //newCode: Financial Ratio --}}
<div class="summary-section">

    <div class="summary-section-header">
        <div>
            <span class="page-label">RATIO</span>
            <h2>Pemasukan vs Pengeluaran</h2>
        </div>
    </div>

    <div class="summary-ratio">

        <div class="summary-ratio-label">
            <span>Pemasukan</span>
            <strong>{{ number_format($incomePercentage, 1) }}%</strong>
        </div>

        <div class="summary-progress">
            <div
                class="summary-progress-income"
                style="width: {{ $incomePercentage }}%">
            </div>
        </div>

        <div class="summary-ratio-label">
            <span>Pengeluaran</span>
            <strong>{{ number_format($expensePercentage, 1) }}%</strong>
        </div>

    </div>

</div>

{{-- //newCode: Quick Insights --}}
<div class="summary-stat-grid">

    <div class="summary-stat-card">
        <span>Total Kategori</span>

        <strong>
            {{ $categoryCount }}
        </strong>

        <small>
            kategori digunakan
        </small>
    </div>

    <div class="summary-stat-card">
        <span>Pengeluaran Terbesar</span>

        <strong>
            {{ $largestExpenseCategory?->category ?? '-' }}
        </strong>

        <small>
            @if($largestExpenseCategory)
                Rp {{ number_format($largestExpenseCategory->total, 0, ',', '.') }}
            @else
                Belum ada pengeluaran
            @endif
        </small>
    </div>

</div>

    {{-- //newCode: Transaction Overview --}}
    <div class="summary-section">

        <div class="summary-section-header">
            <div>
                <span class="page-label">ACTIVITY</span>
                <h2>Aktivitas Transaksi</h2>
            </div>
        </div>

        <div class="summary-activity">

            <div class="summary-activity-item">
                <span>Total Transaksi</span>
                <strong>{{ $transactionCount }}</strong>
            </div>

            <div class="summary-activity-item">
                <span>Pemasukan</span>
                <strong>{{ $incomeCount }}</strong>
            </div>

            <div class="summary-activity-item">
                <span>Pengeluaran</span>
                <strong>{{ $expenseCount }}</strong>
            </div>

        </div>

    </div>

    {{-- //newCode: Category Summary --}}
    <div class="summary-section">

        <div class="summary-section-header">
            <div>
                <span class="page-label">CATEGORIES</span>
                <h2>Ringkasan Kategori</h2>
            </div>
        </div>

        @if($categorySummary->count())

            <div class="category-summary-list">

                @foreach($categorySummary as $item)

                    <div class="category-summary-item">

                        <div class="category-summary-info">
                            <strong>
                                {{ $item->category }}
                            </strong>

                            <small>
                                {{ $item->type === 'income'
                                    ? 'Pemasukan'
                                    : 'Pengeluaran' }}
                            </small>
                        </div>

                        <strong class="category-summary-amount">
                            Rp {{ number_format($item->total, 0, ',', '.') }}
                        </strong>

                    </div>

                @endforeach

            </div>

        @else

            <div class="summary-empty">
                <div>◌</div>
                <h3>Belum ada data</h3>
                <p>
                    Tambahkan transaksi untuk melihat ringkasan.
                </p>
            </div>

        @endif

    </div>

</div>

@endsection

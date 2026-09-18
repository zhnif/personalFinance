@extends('layouts.app')

@section('title', 'Home - Personal Finance')

@section('content')
<div class="dashboard">

    {{-- //newCode: Home Header --}}
    <header class="dashboard-header">
        <div>            
            <h1>One day</h1>
            <p>Kelola keuanganmu dengan lebih mudah.</p>
        </div>

        <a href="{{ route('transactions.create') }}" class="add-button">
            <span>＋</span>
            <span class="add-text">Tambah</span>
        </a>
    </header>

    {{-- //newCode: Balance --}}
    <section class="balance-card">

        <div class="balance-top">
            <div>
                <span>Total Balance</span>

                <h2>
                    Rp {{ number_format($balance, 0, ',', '.') }}
                </h2>
            </div>

            <div class="balance-icon">
                ↗
            </div>
        </div>

        <div class="balance-bottom">

            <div>
                <span>Total Income</span>

                <strong>
                    Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </strong>
            </div>

            <div>
                <span>Total Expense</span>

                <strong>
                    Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </strong>
            </div>

        </div>

    </section>

    {{-- //newCode: Recent Transactions --}}
    <section class="transactions-section">

        <div class="section-header">

            <div>
                <span class="section-label">ACTIVITY</span>
                <h2>Recent Transactions</h2>
            </div>

            <a
                href="{{ route('transactions.index') }}"
                class="view-button"
            >
                View all
            </a>

        </div>

        <div class="transaction-list">

            @forelse ($transactions->take(5) as $transaction)

                <article class="transaction-card">

                    <div class="transaction-icon {{ $transaction->type }}">

                        @if($transaction->type === 'income')
                            ↑
                        @else
                            ↓
                        @endif

                    </div>

                    <div class="transaction-info">

                        <h3>
                            {{ $transaction->title }}
                        </h3>

                        <div class="transaction-meta">

                            <span>
                                {{ $transaction->category }}
                            </span>

                            <span>•</span>

                            <span>
                                {{ $transaction->transaction_date->format('d M Y') }}
                            </span>

                        </div>

                    </div>

                    <div class="transaction-amount {{ $transaction->type }}">

                        {{ $transaction->type === 'income' ? '+' : '-' }}

                        {{ $transaction->formatted_amount }}

                    </div>

                    <div class="transaction-actions">

                        <a
                            href="{{ route('transactions.show', $transaction) }}"
                        >
                            View
                        </a>

                    </div>

                </article>

            @empty

                <div class="empty-state">

                    <div class="empty-icon">
                        📭
                    </div>

                    <h3>
                        Belum ada transaksi
                    </h3>

                    <p>
                        Tambahkan transaksi pertamamu untuk mulai
                        mencatat keuangan.
                    </p>

                    <a
                        href="{{ route('transactions.create') }}"
                        class="empty-button"
                    >
                        + Tambah Transaksi
                    </a>

                </div>

            @endforelse

        </div>

    </section>

</div>
@endsection

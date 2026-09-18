@extends('layouts.app')

@section('title', 'Transactions')

@section('content')

<div class="transactions-page">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <span class="section-label">TRANSACTIONS</span>
            <h1>Semua Transaksi</h1>
            <p>Kelola seluruh pemasukan dan pengeluaran kamu.</p>
        </div>

        <a href="{{ route('transactions.create') }}" class="desktop-add">
            + Tambah Transaksi
        </a>
    </div>

    {{-- Filter Section --}}
    <div class="transaction-filter-section">
        <form action="{{ route('transactions.index') }}"
              method="GET"
              class="filter-box">

            <div class="search-wrapper">
                <span>🔍</span>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari transaksi..."
                >
            </div>

            <select id="type" name="type">
                <option value="">Semua Tipe</option>
                <option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>
                    Pemasukan
                </option>
                <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>
                    Pengeluaran
                </option>
            </select>

            <div class="date-filter">
                <label for="start_date">Dari</label>
                <input
                    type="date"
                    id="start_date"
                    name="start_date"
                    value="{{ request('start_date') }}"
                >
            </div>

            <div class="date-filter">
                <label for="end_date">Sampai</label>
                <input
                    type="date"
                    id="end_date"
                    name="end_date"
                    value="{{ request('end_date') }}"
                >
            </div>

            <button type="submit" class="filter-button">
                Cari
            </button>

            @if(
                request()->filled('search') ||
                request()->filled('type') ||
                request()->filled('start_date') ||
                request()->filled('end_date')
            )
                <a href="{{ route('transactions.index') }}" class="reset-button">
                    Reset
                </a>
            @endif

        </form>
    </div>

    {{-- Transaction Count --}}
    <div class="transaction-count" style="margin-bottom: 12px;">
        <span>
            {{ $transactions->total() }} transaksi ditemukan
        </span>
    </div>

    {{-- Transaction List --}}
    <div class="transaction-list">

        @forelse($transactions as $transaction)

            <div class="transaction-card">

                <div class="transaction-icon {{ $transaction->type }}">
                    {{ $transaction->type === 'income' ? '↓' : '↑' }}
                </div>

                <div class="transaction-info">
                    <h3>{{ $transaction->title }}</h3>

                    <div class="transaction-meta">
                        <span>{{ $transaction->category }}</span>
                        •
                        <span>{{ $transaction->transaction_date->format('d M Y') }}</span>
                    </div>

                    @if($transaction->description)
                        <p style="font-size: 12px; opacity: 0.7; margin-top: 4px;">
                            {{ $transaction->description }}
                        </p>
                    @endif
                </div>

                <strong class="transaction-amount {{ $transaction->type === 'income' ? 'income' : 'expense' }}">
                    {{ $transaction->type === 'income' ? '+' : '-' }} {{ $transaction->formatted_amount }}
                </strong>

                <div class="transaction-actions">
                    <a href="{{ route('transactions.show', $transaction) }}">
                        Lihat
                    </a>

                    <a href="{{ route('transactions.edit', $transaction) }}">
                        Edit
                    </a>

                    <form
                        action="{{ route('transactions.destroy', $transaction) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')"
                        style="display: inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>

        @empty

            {{-- Empty State --}}
            <div class="empty-state">
                <div class="empty-state-icon">
                    ≡
                </div>

                @if(
                    request()->filled('search') ||
                    request()->filled('type') ||
                    request()->filled('start_date') ||
                    request()->filled('end_date')
                )
                    <h3>Transaksi tidak ditemukan</h3>
                    <p>
                        Tidak ada transaksi yang cocok dengan pencarian
                        atau filter yang kamu pilih.
                    </p>

                    <a href="{{ route('transactions.index') }}" class="empty-state-action">
                        Reset Filter
                    </a>
                @else
                    <h3>Belum ada transaksi</h3>
                    <p>
                        Belum ada data transaksi.
                        Yuk mulai catat pemasukan atau pengeluaran kamu.
                    </p>

                    <a href="{{ route('transactions.create') }}" class="empty-state-action">
                        + Tambah Transaksi
                    </a>
                @endif
            </div>

        @endforelse

    </div>

    {{-- Pagination --}}
    @if($transactions->hasPages())
        <div class="pagination">
            {{ $transactions->links() }}
        </div>
    @endif

</div>

@endsection

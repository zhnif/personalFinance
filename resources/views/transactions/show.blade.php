@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')

<div class="detail-page">

    <div class="page-header">
        <div>
            <span class="page-label">TRANSACTION</span>
            <h1>Detail Transaksi</h1>
            <p>Informasi lengkap transaksi.</p>
        </div>
    </div>

    {{-- //newCode: Main Detail Card --}}
    <div class="detail-card">

        <div class="detail-top">

            <div class="detail-type-icon">
                {{ $transaction->type === 'income' ? '↓' : '↑' }}
            </div>

            <div class="detail-type">
                <span>
                    {{ $transaction->type === 'income'
                        ? 'PEMASUKAN'
                        : 'PENGELUARAN' }}
                </span>

                <small>
                    {{ $transaction->category }}
                </small>
            </div>

        </div>

        <div class="detail-main">

            <span class="detail-label">Jumlah</span>

            <h2 class="{{ $transaction->type === 'income'
                ? 'detail-income'
                : 'detail-expense' }}">

                {{ $transaction->formatted_amount }}

            </h2>

            <h3>
                {{ $transaction->title }}
            </h3>

        </div>

        <div class="detail-divider"></div>

        {{-- //newCode: Detail Information --}}
        <div class="detail-info">

            <div class="detail-info-item">
                <span>Tanggal</span>

                <strong>
                    {{ $transaction->transaction_date->format('d M Y') }}
                </strong>
            </div>

            <div class="detail-info-item">
                <span>Kategori</span>

                <strong>
                    {{ $transaction->category }}
                </strong>
            </div>

            <div class="detail-info-item">
                <span>Tipe</span>

                <strong>
                    {{ $transaction->type === 'income'
                        ? 'Pemasukan'
                        : 'Pengeluaran' }}
                </strong>
            </div>

        </div>

        @if($transaction->description)

            <div class="detail-description">

                <span>Deskripsi</span>

                <p>
                    {{ $transaction->description }}
                </p>

            </div>

        @endif

    </div>

    {{-- //newCode: Actions --}}
    <div class="detail-actions">

        <a
            href="{{ route('transactions.index') }}"
            class="detail-back"
        >
            ← Kembali
        </a>

        <a
            href="{{ route('transactions.edit', $transaction) }}"
            class="detail-edit"
        >
            Edit Transaksi
        </a>

    </div>

</div>

@endsection

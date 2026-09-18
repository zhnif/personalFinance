@extends('layouts.app')

@section('title', 'More')

@section('content')

<div class="more-page">

    <div class="page-header">
        <div>
            <span class="page-label">MENU</span>
            <h1>More</h1>
            <p>Pengaturan dan informasi aplikasi.</p>
        </div>
    </div>

    {{-- //newCode: App Info --}}
    <div class="more-card more-app-info">

        <div class="more-app-icon">
            💰
        </div>

        <div>
            <h2>Personal Finance</h2>
            <p>
                Aplikasi sederhana untuk mencatat
                dan memantau keuangan pribadi.
            </p>
        </div>

    </div>

    {{-- //newCode: Menu --}}
    <div class="more-section">

        <span class="page-label">MENU</span>

        <div class="more-menu-list">

            <a href="{{ route('transactions.index') }}"
               class="more-menu-item">

                <div class="more-menu-icon">≡</div>

                <div>
                    <strong>Transactions</strong>
                    <small>Kelola semua transaksi</small>
                </div>

                <span class="more-arrow">›</span>

            </a>

            <a href="{{ route('summary') }}"
               class="more-menu-item">

                <div class="more-menu-icon">◔</div>

                <div>
                    <strong>Summary</strong>
                    <small>Lihat ringkasan keuangan</small>
                </div>

                <span class="more-arrow">›</span>

            </a>

            <a href="{{ route('transactions.create') }}"
               class="more-menu-item">

                <div class="more-menu-icon">＋</div>

                <div>
                    <strong>Tambah Transaksi</strong>
                    <small>Catat pemasukan atau pengeluaran</small>
                </div>

                <span class="more-arrow">›</span>

            </a>

        </div>

    </div>

    {{-- //newCode: Features --}}
    <div class="more-section">

        <span class="page-label">FEATURES</span>

        <div class="more-feature-grid">

            <div class="more-feature-card">
                <strong>💰</strong>
                <span>Pemasukan</span>
            </div>

            <div class="more-feature-card">
                <strong>💸</strong>
                <span>Pengeluaran</span>
            </div>

            <div class="more-feature-card">
                <strong>📊</strong>
                <span>Summary</span>
            </div>

            <div class="more-feature-card">
                <strong>🔎</strong>
                <span>Pencarian</span>
            </div>

            <div class="more-feature-card">
                <strong>📅</strong>
                <span>Filter Tanggal</span>
            </div>

            <div class="more-feature-card">
                <strong>📱</strong>
                <span>Responsive</span>
            </div>

        </div>

    </div>

    {{-- //newCode: App Version --}}
    <div class="more-footer">
        <span>Personal Finance</span>
        <small>Laravel • Blade • MySQL</small>
    </div>

</div>

@endsection

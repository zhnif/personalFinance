<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Personal Finance')</title>
    <link rel="stylesheet" href="{{ asset('css/style3.css') }}">
</head>

<body class="page-transition">

    {{-- Desktop Sidebar (hidden on mobile via CSS) --}}
    <aside class="sidebar">

        <a href="{{ route('home') }}" class="sidebar-brand" title="PersonalFinance">
            <span class="sidebar-brand-icon">💰</span>
            <span>PersonalFinance</span>
        </a>

        <a href="{{ route('home') }}"
           title="Home"
           class="sidebar-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <span class="sidebar-nav-icon">⌂</span>
            <span>Home</span>
        </a>

        <a href="{{ route('transactions.index') }}"
           title="Transactions"
           class="sidebar-nav-item {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
            <span class="sidebar-nav-icon">≡</span>
            <span>Transactions</span>
        </a>

        <a href="{{ route('summary') }}"
           title="Summary"
           class="sidebar-nav-item {{ request()->routeIs('summary') ? 'active' : '' }}">
            <span class="sidebar-nav-icon">◔</span>
            <span>Summary</span>
        </a>

        <a href="{{ route('more') }}"
           title="More"
           class="sidebar-nav-item {{ request()->routeIs('more') ? 'active' : '' }}">
            <span class="sidebar-nav-icon">⋯</span>
            <span>More</span>
        </a>

        <div class="sidebar-divider"></div>

        <a href="{{ route('transactions.create') }}" class="sidebar-add" title="Add Transaction">
            <span>＋</span>
            <span>Add Transaction</span>
        </a>

    </aside>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Mobile Bottom Navigation (hidden on desktop via CSS) --}}
    <nav class="mobile-bottom-nav">

        <a href="{{ route('home') }}"
           class="mobile-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <span class="mobile-nav-icon">⌂</span>
            <span>Home</span>
        </a>

        <a href="{{ route('transactions.index') }}"
           class="mobile-nav-item {{ request()->routeIs('transactions.index') ? 'active' : '' }}">
            <span class="mobile-nav-icon">≡</span>
            <span>Transactions</span>
        </a>

        <a href="{{ route('transactions.create') }}"
           class="mobile-nav-add"
           aria-label="Tambah transaksi">
            <span>＋</span>
        </a>

        <a href="{{ route('summary') }}"
           class="mobile-nav-item {{ request()->routeIs('summary') ? 'active' : '' }}">
            <span class="mobile-nav-icon">◔</span>
            <span>Summary</span>
        </a>

        <a href="{{ route('more') }}"
           class="mobile-nav-item {{ request()->routeIs('more') ? 'active' : '' }}">
            <span class="mobile-nav-icon">⋯</span>
            <span>More</span>
        </a>

    </nav>

</body>
</html>

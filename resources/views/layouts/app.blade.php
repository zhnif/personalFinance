<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Personal Finance')</title>

    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
</head>

<body class="page-transition">

    {{-- //newCode: Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- //newCode: Mobile Bottom Navigation --}}
    <nav class="mobile-bottom-nav">

        <a
            href="{{ route('home') }}"
            class="mobile-nav-item active"
        >
            <span class="mobile-nav-icon">⌂</span>
            <span>Home</span>
        </a>

        <a
            href="{{ route('transactions.index') }}"
            class="mobile-nav-item"
        >
            <span class="mobile-nav-icon">≡</span>
            <span>Transactions</span>
        </a>

        <a
            href="{{ route('transactions.create') }}"
            class="mobile-nav-add"
            aria-label="Tambah transaksi"
        >
            <span>＋</span>
        </a>

        <a
            href="{{ route('summary') }}"
            class="mobile-nav-item"
        >
            <span class="mobile-nav-icon">◔</span>
            <span>Summary</span>
        </a>

        <a
            href="{{ route('more') }}"
            class="mobile-nav-item"
        >
            <span class="mobile-nav-icon">⋯</span>
            <span>More</span>
        </a>

    </nav>

</body>
</html>

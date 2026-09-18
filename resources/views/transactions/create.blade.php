@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')

<div class="form-page">

    <div class="page-header">
        <div>
            <span class="page-label">TRANSACTION</span>
            <h1>Tambah Transaksi</h1>
            <p>Catat pemasukan atau pengeluaran baru.</p>
        </div>
    </div>

    <div class="form-card">

        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            {{-- //newCode: Title --}}
            <div class="form-group">
                <label for="title">Judul Transaksi</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Contoh: Gaji bulanan"
                    required
                >

                @error('title')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- //newCode: Amount --}}
            <div class="form-group">
                <label for="amount">Jumlah</label>

                <input
                    type="number"
                    id="amount"
                    name="amount"
                    value="{{ old('amount') }}"
                    placeholder="0"
                    min="0"
                    step="0.01"
                    required
                >

                @error('amount')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- //newCode: Type --}}
            <div class="form-group">
                <label for="type">Tipe Transaksi</label>

                <select id="type" name="type" required>
                    <option value="">Pilih tipe transaksi</option>

                    <option
                        value="income"
                        {{ old('type') === 'income' ? 'selected' : '' }}
                    >
                        Pemasukan
                    </option>

                    <option
                        value="expense"
                        {{ old('type') === 'expense' ? 'selected' : '' }}
                    >
                        Pengeluaran
                    </option>
                </select>

                @error('type')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- //newCode: Category --}}
            <div class="form-group">
                <label for="category">Kategori</label>

                <select id="category" name="category" required>
                    <option value="">Pilih kategori</option>

                    @foreach([
                        'Makanan',
                        'Transportasi',
                        'Belanja',
                        'Hiburan',
                        'Tagihan',
                        'Gaji',
                        'Bonus',
                        'Lainnya'
                    ] as $category)

                        <option
                            value="{{ $category }}"
                            {{ old('category') === $category ? 'selected' : '' }}
                        >
                            {{ $category }}
                        </option>

                    @endforeach
                </select>

                @error('category')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- //newCode: Date --}}
            <div class="form-group">
                <label for="transaction_date">Tanggal</label>

                <input
                    type="date"
                    id="transaction_date"
                    name="transaction_date"
                    value="{{ old('transaction_date', date('Y-m-d')) }}"
                    required
                >

                @error('transaction_date')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- //newCode: Description --}}
            <div class="form-group">
                <label for="description">Deskripsi</label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Tambahkan catatan jika diperlukan..."
                >{{ old('description') }}</textarea>

                @error('description')
                    <small class="form-error">{{ $message }}</small>
                @enderror
            </div>

            {{-- //newCode: Actions --}}
            <div class="form-actions">

                <a
                    href="{{ route('transactions.index') }}"
                    class="form-cancel"
                >
                    Batal
                </a>

                <button type="submit" class="form-submit">
                    Simpan Transaksi
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

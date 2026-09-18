@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')

<div class="form-page">

    <div class="page-header">
        <div>
            <span class="page-label">TRANSACTION</span>
            <h1>Edit Transaksi</h1>
            <p>Perbarui informasi transaksi kamu.</p>
        </div>
    </div>

    <div class="form-card">

        <form
            action="{{ route('transactions.update', $transaction) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            {{-- //newCode: Title --}}
            <div class="form-group">
                <label for="title">Judul Transaksi</label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $transaction->title) }}"
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
                    value="{{ old('amount', $transaction->amount) }}"
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

                    <option value="income"
                        {{ old('type', $transaction->type) === 'income' ? 'selected' : '' }}>
                        Pemasukan
                    </option>

                    <option value="expense"
                        {{ old('type', $transaction->type) === 'expense' ? 'selected' : '' }}>
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
                            {{ old('category', $transaction->category) === $category ? 'selected' : '' }}
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
                    value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}"
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
                >{{ old('description', $transaction->description) }}</textarea>

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
                    Update Transaksi
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

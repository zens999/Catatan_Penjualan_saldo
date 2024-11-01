@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Transaksi</h1>

    <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="uang_masuk" class="block text-gray-700">Uang Masuk</label>
            <input type="number" name="uang_masuk" id="uang_masuk" value="" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" />
            @error('uang_masuk')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="kembalian" class="block text-gray-700">Kembalian</label>
            <input type="number" name="kembalian" id="kembalian" value="{{ old('kembalian', $transaksi->kembalian) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" disabled />
        </div>

        <div class="mb-4">
            <label for="sisa_hutang" class="block text-gray-700">Sisa Hutang</label>
            <input type="text" name="sisa_hutang" id="sisa_hutang" value="{{ old('sisa_hutang', $transaksi->sisa_hutang) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" disabled />
        </div>

        <div class="mb-4">
            <label for="status" class="block text-gray-700">Status</label>
            <input type="text" name="status" id="status" value="{{ $transaksi->status }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" disabled />
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update Transaksi</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const harga = {{ $transaksi->harga }};
        const uangMasukSebelumnya = {{ $transaksi->uang_masuk }};
        const uangMasukInput = document.getElementById('uang_masuk');
        const kembalianInput = document.getElementById('kembalian');
        const sisaHutangInput = document.getElementById('sisa_hutang');

        // Fungsi perhitungan berdasarkan input uang_masuk
        uangMasukInput.addEventListener('input', function () {
            const uangMasukBaru = parseFloat(uangMasukInput.value) || 0;
            const totalUangMasuk = uangMasukSebelumnya + uangMasukBaru;

            if (totalUangMasuk >= harga) {
                kembalianInput.value = (totalUangMasuk - harga).toFixed(0); // Kembalian jika lunas
                sisaHutangInput.value = '0'; // Sisa hutang lunas
            } else {
                kembalianInput.value = '0'; // Tidak ada kembalian karena belum lunas
                sisaHutangInput.value = (harga - totalUangMasuk).toFixed(0); // Sisa hutang
            }
        });
    });
</script>

    
@endsection

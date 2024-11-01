@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Transaksi') }}
    </h2>
@endsection

@section('content')
    <div class="container mx-auto py-6">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            @if (session('error'))
            <div class="bg-red-500 text-white p-2 mb-4 rounded">
                {{ session('error') }}
            </div>
            @endif
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Tambah Transaksi</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Isi form di bawah untuk menambah transaksi baru.</p>
            </div>
            <form action="{{ route('transaksis.store') }}" method="POST" class="space-y-6 p-6" id="transaksi-form">
                @csrf
                <div>
                    <label for="nama_pembeli" class="block text-sm font-medium text-gray-700">Nama Pembeli</label>
                    <input type="text" name="nama_pembeli" id="nama_pembeli" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>
                
                <div>
                    <label for="nomor" class="block text-sm font-medium text-gray-700">Nomor</label>
                    <input type="text" name="nomor" id="nomor" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="jenis_transaksi" class="block text-sm font-medium text-gray-700">Jenis Transaksi</label>
                    <select name="jenis_transaksi" id="jenis_transaksi" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="saldo">Saldo</option>
                        <option value="pulsa">Pulsa</option>
                        <option value="token">Token</option>
                        <option value="kuota">Kuota</option>
                    </select>
                </div>

                <div>
                    <label for="jumlah_beli" class="block text-sm font-medium text-gray-700">Jumlah Beli</label>
                    <input type="number" name="jumlah_beli" id="jumlah_beli" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                    <input type="number" name="harga" id="harga" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>
                        <option value="hutang">Hutang</option>
                    </select>
                </div>

                <div>
                    <label for="uang_masuk" class="block text-sm font-medium text-gray-700">Uang Masuk</label>
                    <input type="number" name="uang_masuk" id="uang_masuk" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="kembalian" class="block text-sm font-medium text-gray-700">Kembalian</label>
                    <input type="text" name="kembalian" id="kembalian" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-200">
                </div>

                <div>
                    <label for="sisa_hutang" class="block text-sm font-medium text-gray-700">Sisa Hutang</label>
                    <input type="text" name="sisa_hutang" id="sisa_hutang" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-200">
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="status" id="status" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-200">
                </div>

                <div>
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hargaInput = document.getElementById('harga');
            const uangMasukInput = document.getElementById('uang_masuk');
            const metodePembayaranSelect = document.getElementById('metode_pembayaran');
            const kembalianInput = document.getElementById('kembalian');
            const sisaHutangInput = document.getElementById('sisa_hutang');
            const statusInput = document.getElementById('status');

            function formatRupiah(angka) {
                // Membulatkan angka dan mengubahnya menjadi format rupiah
                return 'Rp. ' + parseInt(angka).toLocaleString('id-ID', {minimumFractionDigits: 0});
            }

            function calculate() {
                const harga = parseFloat(hargaInput.value) || 0;
                const uangMasuk = parseFloat(uangMasukInput.value) || 0;
                const metodePembayaran = metodePembayaranSelect.value;

                if (metodePembayaran === 'hutang') {
                    uangMasukInput.value = ''; // Reset uang masuk untuk hutang
                    kembalianInput.value = formatRupiah(0);
                    sisaHutangInput.value = formatRupiah(harga);
                    statusInput.value = 'belum_lunas';
                } else {
                    if (uangMasuk < harga) {
                        statusInput.value = 'belum_lunas';
                        kembalianInput.value = formatRupiah(0);
                        sisaHutangInput.value = formatRupiah(harga - uangMasuk);
                    } else {
                        statusInput.value = 'lunas';
                        kembalianInput.value = formatRupiah(uangMasuk - harga);
                        sisaHutangInput.value = formatRupiah(0);
                    }
                }
            }

            hargaInput.addEventListener('input', calculate);
            uangMasukInput.addEventListener('input', calculate);
            metodePembayaranSelect.addEventListener('change', calculate);
        });
    </script>
@endsection

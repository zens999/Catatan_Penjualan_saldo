@extends('layouts.app')
@section('header')
<h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Daftar Transaksi</h1>
@endsection
@section('content')
<div class="container mx-auto p-4">

    <!-- Success message -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Transaction Button -->
    <div class="mb-4">
        <a href="{{ route('transaksis.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold text-sm rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-700 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" height="20px" viewBox="0 0 24 24" width="20px" fill="white">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M13 11h8v2h-8v8h-2v-8H3v-2h8V3h2v8z"/>
            </svg>
            Tambah Transaksi
        </a>
    </div>

    <!-- Transaction Table -->
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-50">
                <th class="py-2 px-4 border-b text-left">No</th>
                <th class="py-2 px-4 border-b text-left">Nama Pembeli</th>
                <th class="py-2 px-4 border-b text-left">Nomor</th>
                <th class="py-2 px-4 border-b text-left">Jenis Transaksi</th>
                <th class="py-2 px-4 border-b text-left">Jumlah Beli</th>
                <th class="py-2 px-4 border-b text-left">Harga</th>
                <th class="py-2 px-4 border-b text-left">Metode Pembayaran</th>
                <th class="py-2 px-4 border-b text-left">Uang Masuk</th>
                <th class="py-2 px-4 border-b text-left">Kembalian</th>
                <th class="py-2 px-4 border-b text-left">Sisa Hutang</th>
                <th class="py-2 px-4 border-b text-left">Status</th>
                <th class="py-2 px-4 border-b text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $transaksi)
            <tr class="hover:bg-gray-100">
                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                <td class="py-2 px-4 border-b">{{ $transaksi->nama_pembeli }}</td>
                <td class="py-2 px-4 border-b">{{ $transaksi->nomor }}</td>
                <td class="py-2 px-4 border-b">{{ $transaksi->jenis_transaksi }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($transaksi->jumlah_beli, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">{{ $transaksi->metode_pembayaran }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($transaksi->uang_masuk, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">{{ is_numeric($transaksi->sisa_hutang) ? number_format($transaksi->sisa_hutang, 0, ',', '.') : $transaksi->sisa_hutang }}</td>
                <td class="py-2 px-4 border-b">
                    <span class="{{ $transaksi->status === 'lunas' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} inline-block px-2 py-1 rounded">
                        {{ ucfirst($transaksi->status) }}
                    </span>
                </td>                                
                <td class="py-2 px-4 border-b">
                    @if ($transaksi->status === 'belum_lunas')
                        <a href="{{ route('transaksis.edit', $transaksi->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

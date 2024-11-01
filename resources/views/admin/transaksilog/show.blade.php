{{-- @extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Rekam Jejak Transaksi</h1>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nama Pembeli</th>
                <th class="py-2 px-4 border-b">Nomor</th>
                <th class="py-2 px-4 border-b">Jenis Transaksi</th>
                <th class="py-2 px-4 border-b">Jumlah Beli</th>
                <th class="py-2 px-4 border-b">Harga</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Tanggal</th>
                <th class="py-2 px-4 border-b">Administrator</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $logs)
            <tr>
                <td class="py-2 px-4 border-b">{{ $logs->nama_pembeli }}</td>
                <td class="py-2 px-4 border-b">{{ $logs->nomor }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($logs->jenis_transaksi) }}</td>
                <td class="py-2 px-4 border-b">{{ $logs->jumlah_beli }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($logs->harga, 2) }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($logs->status) }}</td>
                <td class="py-2 px-4 border-b">{{ $logs->created_at }}</td>
                <td class="py-2 px-4 border-b">{{ $logs->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection --}}
<!-- resources/views/admin/transaksilogs/logs.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Aktivitas Transaksi: {{ $karyawan->name }}</h1>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-50">
                <th class="py-2 px-4 border-b text-left">No</th>
                <th class="py-2 px-4 border-b text-left">Nama Pembeli</th>
                <th class="py-2 px-4 border-b text-left">Jenis Transaksi</th>
                <th class="py-2 px-4 border-b text-left">Harga</th>
                <th class="py-2 px-4 border-b text-left">Uang Masuk</th>
                <th class="py-2 px-4 border-b text-left">Status</th>
                <th class="py-2 px-4 border-b text-left">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr>
                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                <td class="py-2 px-4 border-b">{{ $transaksi->nama_pembeli }}</td>
                <td class="py-2 px-4 border-b">{{ $transaksi->jenis_transaksi }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">{{ number_format($transaksi->uang_masuk, 0, ',', '.') }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($transaksi->status) }}</td>
                <td class="py-2 px-4 border-b">{{ $transaksi->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <a href="{{ route('admin.transaksilogs.index') }}" class="inline-block px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Kembali ke Daftar Karyawan
        </a>
    </div>
</div>
@endsection

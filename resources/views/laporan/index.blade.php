@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight mb-6">Laporan</h1>
<a href="{{ route('reports.exportPDF') }}" class="btn btn-primary mb-3">Ekspor PDF</a>
    <!-- Bagian untuk Laporan Transaksi -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Laporan Transaksi Yang Sudah Lunas</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Nama Pembeli</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Jumlah Beli</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                @if ($transaksi->status === 'lunas')
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-b">{{ $transaksi->nama_pembeli }}</td>
                        <td class="px-6 py-4 border-b">{{ number_format($transaksi->jumlah_beli, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 border-b">{{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 border-b">{{ $transaksi->created_at ? $transaksi->created_at->format('d-m-Y') : 'Tidak tersedia' }}</td>
                    </tr>
                @endif

                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">Tidak ada data transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bagian untuk Laporan Belum Lunas -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Laporan Belum Lunas</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Nama Pembeli</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Jumlah Hutang</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Tanggal Hutang</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $transaksi)
                    @if ($transaksi->status === 'belum_lunas')
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4 border-b">{{ $transaksi->nama_pembeli }}</td>
                            <td class="px-6 py-4 border-b">{{ number_format($transaksi->sisa_hutang, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 border-b">{{ $transaksi->created_at ? $transaksi->created_at->format('d-m-Y') : 'Tidak tersedia' }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center">Tidak ada data hutang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Bagian untuk Laporan Setor -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-4">Laporan Setor</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Nominal</th>
                    <th class="px-6 py-3 border-b text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($setors as $setor)
                    <tr class="hover:bg-gray-100">
                        <td class="px-6 py-4 border-b">{{ $setor->karyawan->name }}</td>
                        <td class="px-6 py-4 border-b">{{ number_format($setor->nominal, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 border-b">{{ $setor->tanggal ? $setor->tanggal->format('d-m-Y') : 'Tidak tersedia' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center">Tidak ada data setor.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

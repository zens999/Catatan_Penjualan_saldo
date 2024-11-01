<!-- resources/views/admin/transaksilogs/index.blade.php -->
@extends('layouts.app')
@section('header')
<h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Daftar Karyawan</h1>
@endsection
@section('content')
<div class="container mx-auto p-4">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($karyawans as $karyawan)
        <div class="bg-white shadow-md rounded-lg p-4">
            <h2 class="text-lg font-semibold">{{ $karyawan->name }}</h2>
            <p class="text-gray-600">{{ $karyawan->email }}</p>
            <div class="mt-4">
                <a href="{{ route('admin.transaksilogs.showLogs', $karyawan->id) }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Lihat Aktivitas
                </a>
                <a href="{{ route('admin.users.addSaldo', $karyawan->id) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 mt-2">
                    Tambah Saldo
                </a>
                @if ($karyawan->pendapatan > 0)
                    <a href="{{ route('admin.tarikSetor', $karyawan->id) }}" class="inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 mt-2">
                        Tarik Setor
                    </a>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

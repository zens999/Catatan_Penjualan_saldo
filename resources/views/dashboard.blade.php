@extends('layouts.app')
@section('header')
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
    Selamat Datang, {{ Auth::user()->name }}
</h2> 
@endsection

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-lg font-semibold">Saldo</h2>
        <p class="text-2xl font-bold">Rp. {{ number_format($saldo, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white shadow-md rounded-lg p-4">
        <h2 class="text-lg font-semibold">Pendapatan Hari Ini</h2>
        <p class="text-2xl font-bold">Rp. {{ number_format($pendapatanHariIni, 0, ','. '.') }}</p>
    </div>
</div>

    @if(auth()->user()->role == 'admin')
    <!-- Form Tambah Saldo untuk Admin -->
    <div class="mt-6">
        <form action="{{ route('dashboard.addSaldo') }}" method="POST">
            @csrf
            @if(session('success'))
                <div class="bg-green-500 text-white p-2 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif
            <div class="mb-4">
                <label for="saldo" class="block text-gray-700">Tambah Saldo</label>
                <input type="number" name="saldo" id="saldo" class="border border-gray-300 p-2 w-full rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Tambah Saldo
            </button>
        </form>
    </div>
    @endif
    
@endsection


@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Formulir Setoran</h1>
    <form action="{{ route('setors.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf

        <!-- Dropdown untuk memilih Karyawan -->
        <div class="mb-4">
            <label for="karyawan_id" class="block text-gray-700 font-semibold">Karyawan</label>
            <select name="karyawan_id" id="karyawan_id" required class="w-full px-4 py-2 border rounded-md">
                <option value="" disabled selected>Pilih Karyawan</option>
                @foreach($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown untuk memilih Admin -->
        <div class="mb-4">
            <label for="admin_id" class="block text-gray-700 font-semibold">Admin</label>
            <select name="admin_id" id="admin_id" required class="w-full px-4 py-2 border rounded-md">
                <option value="" disabled selected>Pilih Admin</option>
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input Nominal -->
        <div class="mb-4">
            <label for="nominal" class="block text-gray-700 font-semibold">Nominal</label>
            <input type="number" name="nominal" id="nominal" required class="w-full px-4 py-2 border rounded-md" placeholder="Masukkan Nominal Setoran">
        </div>

        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Tarik Setor</button>
    </form>
</div>
@endsection

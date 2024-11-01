<!-- resources/views/admin/users/add-saldo.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Tambah Saldo untuk {{ $user->name }}</h1>

    <form action="{{ route('admin.users.storeSaldo', $user->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="saldo" class="block text-gray-700">Saldo</label>
            <input type="number" id="saldo" name="saldo" class="border border-gray-300 rounded-md p-2 w-full" placeholder="Jumlah saldo" required>
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Tambah Saldo</button>
    </form>
</div>
@endsection

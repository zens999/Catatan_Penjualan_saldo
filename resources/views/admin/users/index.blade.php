<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.app')
@section('header')
<h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Daftar User</h1>
@endsection
@section('content')
<div class="container mx-auto p-4">
    

    <!-- Success message -->
    @if (session('success'))
        <div class="bg-green-500 text-white p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-4">
        <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold text-sm rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-700 transition duration-150 ease-in-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" height="20px" viewBox="0 0 24 24" width="20px" fill="white">
                <path d="M0 0h24v24H0V0z" fill="none"/>
                <path d="M13 11h8v2h-8v8h-2v-8H3v-2h8V3h2v8z"/>
            </svg>
            Tambah User
        </a>
    </div>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr class="bg-gray-50">
                <th class="py-2 px-4 border-b">No</th>
                <th class="py-2 px-4 border-b">Nama</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Role</th>
                <th class="py-2 px-4 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                <td class="py-2 px-4 border-b">{{ ucfirst($user->role) }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

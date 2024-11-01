@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <div class="py-8">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-semibold leading-tight">Riwayat Setoran</h2>
        </div>

        <div class="min-w-full shadow overflow-hidden bg-white dark:bg-gray-800 rounded-lg">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Nama Karyawan
                        </th>
                        <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Admin
                        </th>
                        <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Nominal
                        </th>
                        <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Tanggal Ditarik
                        </th>
                        <th class="px-5 py-3 border-b border-gray-200 bg-gray-100 dark:bg-gray-700 text-left text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($setors as $setor)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-900 text-sm">
                                <p class="text-gray-900 dark:text-gray-100 whitespace-no-wrap">{{ $setor->karyawan->name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-900 text-sm">
                                <p class="text-gray-900 dark:text-gray-100 whitespace-no-wrap">{{ $setor->admin->name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-900 text-sm">
                                <p class="text-gray-900 dark:text-gray-100 whitespace-no-wrap">Rp. {{ number_format($setor->nominal, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-900 text-sm">
                                <p class="text-gray-900 dark:text-gray-100 whitespace-no-wrap">{{ $setor->tanggal_ditarik }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-900 text-sm">
                                {{-- @if(is_null($setor->read_at))
                                    <form action="{{ route('setors.markAsRead', $setor->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Tandai Dibaca
                                        </button>
                                    </form>
                                @else
                                    <span class="text-green-500 font-semibold">Sudah Dibaca</span>
                                @endif --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-900 text-center text-sm">
                                <p class="text-gray-500 dark:text-gray-300">Belum ada riwayat setoran.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Data Paket Tiket - Admin')

@section('content')
<div class="mb-4 flex justify-between items-center">
    <h1 class="text-2xl font-black text-gray-900 tracking-tight">Paket Tiket</h1>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500 font-bold tracking-wider">
                    <th class="py-3 px-4">Nama Paket</th>
                    <th class="py-3 px-4">Harga</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-sm">
                @forelse($packages as $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-4 font-semibold text-gray-900">
                        {{ $p->nama_paket }}
                    </td>
                    <td class="py-3 px-4 text-green-600 font-bold">
                        Rp {{ number_format($p->harga, 0, ',', '.') }}
                    </td>
                    <td class="py-3 px-4 text-center">
                        <form action="{{ route('admin.ticket_packages.toggle', $p->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-2 py-1 rounded-full text-xs font-bold {{ $p->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="py-3 px-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.ticket_packages.edit', $p->id) }}" class="text-blue-500 hover:text-blue-700 transition" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-500 italic">Belum ada data paket tiket.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

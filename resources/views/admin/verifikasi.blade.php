@extends('layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-black text-gray-900 tracking-tight">Verifikasi Pembayaran Manual</h1>
        <p class="text-sm text-gray-500 mt-1">Daftar pendaftar yang telah mengunggah bukti transfer manual dan menunggu persetujuan Anda.</p>
    </div>
</div>

@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 font-semibold flex items-center gap-2">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase tracking-wider text-gray-500">
                    <th class="p-4 font-bold">Peserta & Order ID</th>
                    <th class="p-4 font-bold">Total Pembayaran</th>
                    <th class="p-4 font-bold text-center">Bukti Bayar</th>
                    <th class="p-4 font-bold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-sm">
                @forelse($participants as $participant)
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="p-4">
                        <div class="font-bold text-gray-900">{{ $participant->full_name }}</div>
                        <div class="text-xs text-gray-500">{{ $participant->email }}</div>
                        <div class="text-xs font-mono text-[#0b4d75] mt-1">{{ $participant->order_id }}</div>
                    </td>
                    <td class="p-4 font-semibold text-gray-800">
                        Rp {{ number_format($participant->gross_amount, 0, ',', '.') }}
                    </td>
                    <td class="p-4 text-center" x-data="{ open: false }">
                        <button @click="open = true" type="button" class="inline-flex items-center gap-1 bg-blue-50 text-blue-600 hover:bg-blue-100 hover:text-blue-700 px-3 py-1.5 rounded-lg text-xs font-bold transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            Lihat Bukti
                        </button>

                        <!-- Modal Pop-up -->
                        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75 p-4"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0">
                            
                            <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col" @click.away="open = false">
                                <div class="flex justify-between items-center p-4 border-b">
                                    <h3 class="font-bold text-gray-800">Bukti Pembayaran: {{ $participant->full_name }}</h3>
                                    <button @click="open = false" class="text-gray-500 hover:text-red-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                </div>
                                <div class="p-4 overflow-auto flex-1 flex justify-center items-center bg-gray-50">
                                    <img src="{{ asset('storage/' . $participant->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-full max-h-[70vh] rounded shadow-sm">
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <form action="{{ route('admin.verifikasi.terima', $participant->id) }}" method="POST" onsubmit="return confirm('Anda yakin bukti valid dan melunaskan pembayaran pendaftar ini?');">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-lg transition" title="Terima & Lunaskan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                </button>
                            </form>
                            <form action="{{ route('admin.verifikasi.tolak', $participant->id) }}" method="POST" onsubmit="return confirm('Anda yakin menolak bukti ini? Status akan dikembalikan menjadi pending dan pendaftar harus mengunggah ulang.');">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition" title="Tolak">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <p class="font-bold text-gray-700">Tidak Ada Verifikasi Pending</p>
                            <p class="text-sm mt-1 text-gray-400">Semua bukti pembayaran telah diperiksa.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($participants->hasPages())
    <div class="p-4 border-t border-gray-200">
        {{ $participants->links() }}
    </div>
    @endif
</div>
@endsection

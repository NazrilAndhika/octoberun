@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 pt-32 min-h-screen">
    <div class="text-center mb-12">
        <h1 class="font-sporty font-black text-3xl md:text-4xl italic text-[#0b4d75] uppercase tracking-wide">Refund Policy</h1>
        <p class="mt-3 text-gray-500 text-sm md:text-base">Kebijakan Pengembalian Dana</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-red-100 p-8 text-center">
        <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6 text-red-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Non-Refundable</h3>
        <p class="text-gray-700 font-medium leading-relaxed">
            Seluruh transaksi pembelian tiket bersifat final. Tiket yang telah dibayar tidak dapat dibatalkan atau dikembalikan uangnya (Non-Refundable) dengan alasan apa pun.
        </p>
    </div>
</div>
@endsection

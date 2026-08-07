{{-- resources/views/admin/datapendaftar.blade.php --}}
@extends('layouts.admin')

@section('title', 'Data Pendaftar - Admin OCTOBERUN 2026')

@section('content')

{{-- ============================================================
     HEADER HALAMAN
============================================================ --}}
<div class="mb-2">
    <h1 class="text-2xl font-black text-gray-900 tracking-tight">Data Pendaftar</h1>
    <nav class="flex items-center gap-1.5 text-xs text-gray-400 mt-1 font-medium">
        <span>Dashboard</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span>Pendaftar</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-[#0b4d75] font-bold">Data Pendaftar</span>
    </nav>
</div>


{{-- ============================================================
     FILTER & SEARCH BAR
============================================================ --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 mb-4">
    <form method="GET" action="{{ route('admin.datapendaftar') }}" id="filter-form">
        <div class="flex flex-wrap items-center gap-3">

            {{-- Search --}}
            <div class="relative flex-1 min-w-[220px]">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                <input
                    type="text"
                    id="search-input"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, email, No. HP, atau order ID..."
                    class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50"
                >
            </div>

            {{-- Status Filter --}}
            <select name="status" id="status-filter" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 cursor-pointer">
                <option value="all" {{ request('status', 'all') === 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="paid"    {{ request('status') === 'paid'    ? 'selected' : '' }}>Lunas</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="failed"  {{ request('status') === 'failed'  ? 'selected' : '' }}>Gagal</option>
                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired</option>
            </select>

            {{-- Jersey Size Filter --}}
            <select name="jersey_size" id="jersey-filter" class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 cursor-pointer">
                <option value="all" {{ request('jersey_size', 'all') === 'all' ? 'selected' : '' }}>Semua Ukuran Jersey</option>
                @foreach(['XS','S','M','L','XL','XXL'] as $size)
                    <option value="{{ $size }}" {{ request('jersey_size') === $size ? 'selected' : '' }}>{{ $size }}</option>
                @endforeach
            </select>

            {{-- Date From --}}
            <input type="date" name="date_from" id="date-from" value="{{ request('date_from') }}"
                class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50"
                placeholder="Dari Tanggal">

            {{-- Submit & Reset --}}
            <button type="submit" id="btn-filter"
                class="bg-[#0b4d75] hover:bg-[#083b5c] text-white text-sm font-semibold px-5 py-2 rounded-lg transition">
                Filter
            </button>
            <a href="{{ route('admin.datapendaftar') }}" id="btn-reset"
                class="text-sm font-semibold text-gray-500 hover:text-red-500 px-3 py-2 rounded-lg border border-gray-200 hover:border-red-200 transition bg-gray-50">
                Reset
            </a>
        </div>
    </form>
</div>

{{-- ============================================================
     TABEL DATA PENDAFTAR
============================================================ --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

    {{-- Toolbar Export --}}
    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
        <p class="text-sm text-gray-500 font-medium">
            Menampilkan <span class="font-bold text-gray-900">{{ $participants->firstItem() ?? 0 }}</span> -
            <span class="font-bold text-gray-900">{{ $participants->lastItem() ?? 0 }}</span>
            dari <span class="font-bold text-gray-900">{{ number_format($participants->total(), 0, ',', '.') }}</span> data
        </p>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.datapendaftar.export', request()->query()) }}" id="btn-export-excel"
                class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-lg border border-green-300 bg-green-50 text-green-700 hover:bg-green-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Export Excel
            </a>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50/80 border-b border-gray-200 text-left">
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">No. Order</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Nama Peserta</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Ukuran Jersey</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">No. HP</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Email</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Status Pembayaran</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap">Tgl Daftar</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider whitespace-nowrap text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($participants as $participant)
                <tr class="hover:bg-blue-50/30 transition-colors duration-150 group">
                    <td class="px-5 py-4 whitespace-nowrap">
                        <a href="{{ route('admin.datapendaftar.show', $participant->id) }}"
                            class="text-[#0b4d75] font-semibold text-xs hover:underline">
                            {{ $participant->order_id }}
                        </a>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $participant->full_name }}</p>
                            <p class="text-xs text-gray-400">BIB: {{ $participant->bib_name }}</p>
                        </div>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="inline-block bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $participant->jersey_size }}
                        </span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-gray-600 font-medium">
                        {{ $participant->whatsapp }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-gray-500">
                        {{ $participant->email }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        @php
                            $statusConfig = [
                                'paid'    => ['label' => 'Lunas',   'class' => 'bg-green-100 text-green-700 border border-green-200'],
                                'pending' => ['label' => 'Pending', 'class' => 'bg-amber-100 text-amber-700 border border-amber-200'],
                                'failed'  => ['label' => 'Gagal',   'class' => 'bg-red-100 text-red-700 border border-red-200'],
                                'expired' => ['label' => 'Expired', 'class' => 'bg-gray-100 text-gray-600 border border-gray-200'],
                            ];
                            $cfg = $statusConfig[$participant->payment_status] ?? ['label' => ucfirst($participant->payment_status), 'class' => 'bg-gray-100 text-gray-600'];
                        @endphp
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $cfg['class'] }}">
                            <span class="w-1.5 h-1.5 rounded-full 
                                {{ $participant->payment_status === 'paid' ? 'bg-green-500' : '' }}
                                {{ $participant->payment_status === 'pending' ? 'bg-amber-500' : '' }}
                                {{ $participant->payment_status === 'failed' ? 'bg-red-500' : '' }}
                                {{ $participant->payment_status === 'expired' ? 'bg-gray-400' : '' }}
                            "></span>
                            {{ $cfg['label'] }}
                        </span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-gray-500 text-sm">
                        {{ $participant->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-center">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Lihat Detail --}}
                            <a href="{{ route('admin.datapendaftar.show', $participant->id) }}"
                                id="btn-view-{{ $participant->id }}"
                                title="Lihat Detail"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-sky-50 hover:bg-sky-100 text-sky-600 transition border border-sky-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            </a>
                            {{-- Edit Status --}}
                            <button type="button"
                                id="btn-edit-{{ $participant->id }}"
                                title="Ubah Status"
                                onclick="openStatusModal({{ $participant->id }}, '{{ $participant->payment_status }}', '{{ $participant->full_name }}')"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 transition border border-amber-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>
                            {{-- Download bukti --}}
                            @if($participant->payment_proof)
                            <a href="{{ Storage::url($participant->payment_proof) }}" target="_blank"
                                id="btn-download-{{ $participant->id }}"
                                title="Unduh Bukti Bayar"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-green-50 hover:bg-green-100 text-green-600 transition border border-green-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            </a>
                            @else
                            <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-50 text-gray-300 border border-gray-200" title="Tidak ada bukti">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            </span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            </div>
                            <p class="text-gray-500 font-semibold text-sm">Belum ada data pendaftar ditemukan.</p>
                            <p class="text-gray-400 text-xs">Coba ubah filter atau tambah data pendaftar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination Footer --}}
    <div class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-100 gap-3">
        <p class="text-sm text-gray-500">
            Menampilkan {{ $participants->firstItem() ?? 0 }} - {{ $participants->lastItem() ?? 0 }} dari {{ number_format($participants->total(), 0, ',', '.') }} data
        </p>
        <div class="flex items-center gap-4">
            {{-- Per page selector --}}
            <form method="GET" action="{{ route('admin.datapendaftar') }}" id="per-page-form">
                @foreach(request()->except(['page', 'per_page']) as $key => $val)
                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                @endforeach
                <select name="per_page" id="per-page-select" onchange="this.form.submit()"
                    class="text-sm border border-gray-300 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50">
                    @foreach([10, 25, 50, 100] as $opt)
                        <option value="{{ $opt }}" {{ $perPage == $opt ? 'selected' : '' }}>{{ $opt }} / halaman</option>
                    @endforeach
                </select>
            </form>

            {{-- Pagination Links --}}
            <div class="flex items-center gap-1">
                {{-- Prev --}}
                @if($participants->onFirstPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-300 cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    </span>
                @else
                    <a href="{{ $participants->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                    </a>
                @endif

                {{-- Page Numbers --}}
                @php
                    $currentPage  = $participants->currentPage();
                    $lastPage     = $participants->lastPage();
                    $pagesShown   = [];

                    if ($lastPage <= 7) {
                        $pagesShown = range(1, $lastPage);
                    } else {
                        $pagesShown = array_unique(array_filter(
                            array_merge(
                                [1, 2],
                                range(max(1, $currentPage - 1), min($lastPage, $currentPage + 1)),
                                [$lastPage - 1, $lastPage]
                            )
                        ));
                        sort($pagesShown);
                    }
                @endphp

                @php $prev = null; @endphp
                @foreach($pagesShown as $page)
                    @if($prev !== null && $page > $prev + 1)
                        <span class="text-gray-400 px-1">...</span>
                    @endif
                    @if($page === $currentPage)
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#0b4d75] text-white text-sm font-bold">{{ $page }}</span>
                    @else
                        <a href="{{ $participants->url($page) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] text-sm transition">{{ $page }}</a>
                    @endif
                    @php $prev = $page; @endphp
                @endforeach

                {{-- Next --}}
                @if($participants->hasMorePages())
                    <a href="{{ $participants->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </a>
                @else
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-300 cursor-not-allowed">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </span>
                @endif
            </div>
        </div>
    </div>

</div>


{{-- ============================================================
     MODAL UBAH STATUS PEMBAYARAN
============================================================ --}}
<div id="status-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">
        <div class="bg-gradient-to-r from-[#0b4d75] to-[#0d6096] p-5">
            <h3 class="text-white font-bold text-lg">Ubah Status Pembayaran</h3>
            <p class="text-blue-200 text-sm mt-0.5" id="modal-peserta-name">–</p>
        </div>
        <form id="status-form" method="POST" class="p-6">
            @csrf
            @method('PATCH')
            <label class="block text-sm font-semibold text-gray-700 mb-2">Status Baru</label>
            <select name="payment_status" id="modal-status-select"
                class="w-full border border-gray-300 rounded-lg px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] text-sm mb-6">
                <option value="paid">✅ Lunas</option>
                <option value="pending">⏳ Pending</option>
                <option value="failed">❌ Gagal</option>
                <option value="expired">🕒 Expired</option>
            </select>
            <div class="flex gap-3">
                <button type="button" onclick="closeStatusModal()"
                    class="flex-1 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" id="btn-modal-simpan"
                    class="flex-1 py-2.5 rounded-xl bg-[#0b4d75] hover:bg-[#083b5c] text-white font-bold text-sm transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Auto-submit filter on select change
    document.querySelectorAll('#status-filter, #jersey-filter').forEach(el => {
        el.addEventListener('change', () => document.getElementById('filter-form').submit());
    });

    // Modal helpers
    function openStatusModal(id, currentStatus, name) {
        document.getElementById('modal-peserta-name').textContent = name;
        document.getElementById('modal-status-select').value = currentStatus;
        document.getElementById('status-form').action = `/admin-gsc/datapendaftar/${id}/status`;
        document.getElementById('status-modal').classList.remove('hidden');
        document.getElementById('status-modal').classList.add('flex');
    }

    function closeStatusModal() {
        document.getElementById('status-modal').classList.add('hidden');
        document.getElementById('status-modal').classList.remove('flex');
    }

    // Close modal on backdrop click
    document.getElementById('status-modal').addEventListener('click', function(e) {
        if (e.target === this) closeStatusModal();
    });
</script>
@endpush

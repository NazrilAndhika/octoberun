{{-- resources/views/admin/faq/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'FAQ (Pertanyaan) - Admin OCTOBERUN 2026')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-2xl font-black text-gray-900 tracking-tight">FAQ (Pertanyaan)</h1>

</div>

{{-- FLASH MESSAGE --}}
@if(session('success'))
<div id="flash-success" class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-5 text-sm font-semibold">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    {{ session('success') }}
</div>
<script>setTimeout(() => { document.getElementById('flash-success')?.remove(); }, 3500);</script>
@endif

{{-- TOOLBAR: Filter kiri + Tambah FAQ kanan --}}
<div class="flex flex-wrap items-center justify-between gap-3 mb-4">

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('admin.faq') }}" id="faq-filter-form" class="flex flex-wrap items-center gap-3">
        {{-- Search --}}
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            <input type="text" name="search" id="faq-search" value="{{ request('search') }}"
                placeholder="Cari pertanyaan..."
                class="pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 w-56">
        </div>

        {{-- Status --}}
        <select name="status" id="faq-status" onchange="document.getElementById('faq-filter-form').submit()"
            class="text-sm border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] bg-gray-50 cursor-pointer">
            <option value="all"      {{ request('status', 'all') === 'all'      ? 'selected' : '' }}>Semua Status</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Aktif</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </form>

    {{-- Aksi Kanan --}}
    <div class="flex items-center gap-2">
        @if(request()->anyFilled(['search', 'status']))
        <a href="{{ route('admin.faq') }}"
            class="text-sm font-semibold text-gray-500 hover:text-red-500 px-3 py-2 rounded-lg border border-gray-200 hover:border-red-200 transition bg-gray-50">
            Reset Filter
        </a>
        @endif
        <a href="{{ route('admin.faq.create') }}" id="btn-tambah-faq"
            class="inline-flex items-center gap-2 bg-[#0b4d75] hover:bg-[#083b5c] text-white text-sm font-bold px-5 py-2.5 rounded-xl transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            Tambah FAQ
        </a>
    </div>
</div>

{{-- TABEL FAQ --}}
<div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50/80 border-b border-gray-200 text-left">
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider w-12">No.</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Pertanyaan</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Jawaban</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-20">Urutan</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-24">Status</th>
                    <th class="px-5 py-3.5 text-xs font-bold text-gray-500 uppercase tracking-wider text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($faqs as $index => $faq)
                <tr class="hover:bg-blue-50/20 transition-colors duration-150">
                    {{-- No --}}
                    <td class="px-5 py-4 text-gray-500 font-semibold whitespace-nowrap">
                        {{ $faqs->firstItem() + $index }}.
                    </td>
                    {{-- Pertanyaan --}}
                    <td class="px-5 py-4">
                        <p class="font-semibold text-gray-800 text-sm leading-snug max-w-xs">{{ $faq->question }}</p>
                    </td>
                    {{-- Jawaban (dipotong) --}}
                    <td class="px-5 py-4">
                        <p class="text-gray-500 text-sm max-w-sm">{{ Str::limit($faq->answer, 80) }}</p>
                    </td>
                    {{-- Urutan --}}
                    <td class="px-5 py-4 text-center">
                        <span class="inline-block bg-gray-100 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">
                            {{ $faq->order }}
                        </span>
                    </td>
                    {{-- Status --}}
                    <td class="px-5 py-4 text-center">
                        <form method="POST" action="{{ route('admin.faq.toggle', $faq->id) }}" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" id="btn-toggle-{{ $faq->id }}" title="{{ $faq->is_active ? 'Klik untuk Nonaktifkan' : 'Klik untuk Aktifkan' }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold border transition cursor-pointer
                                {{ $faq->is_active
                                    ? 'bg-green-50 text-green-700 border-green-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200'
                                    : 'bg-gray-100 text-gray-500 border-gray-200 hover:bg-green-50 hover:text-green-700 hover:border-green-200' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $faq->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    {{-- Aksi --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Edit --}}
                            <a href="{{ route('admin.faq.edit', $faq->id) }}" id="btn-edit-faq-{{ $faq->id }}" title="Edit FAQ"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 transition border border-amber-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            {{-- Hapus --}}
                            <button type="button" id="btn-hapus-faq-{{ $faq->id }}" title="Hapus FAQ"
                                onclick="confirmDelete({{ $faq->id }}, '{{ addslashes(Str::limit($faq->question, 40)) }}')"
                                class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-500 transition border border-red-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <p class="text-gray-500 font-semibold text-sm">Belum ada FAQ.</p>
                            <a href="{{ route('admin.faq.create') }}" class="text-[#0b4d75] font-bold text-sm hover:underline">+ Tambah FAQ pertama</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer Pagination --}}
    <div class="flex flex-col sm:flex-row items-center justify-between px-6 py-4 border-t border-gray-100 gap-3">
        <p class="text-sm text-gray-500">
            Menampilkan <span class="font-bold text-gray-900">{{ $faqs->firstItem() ?? 0 }}</span> -
            <span class="font-bold text-gray-900">{{ $faqs->lastItem() ?? 0 }}</span>
            dari <span class="font-bold text-gray-900">{{ $faqs->total() }}</span> data
        </p>

        <div class="flex items-center gap-1">
            @if($faqs->onFirstPage())
                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-gray-100 text-gray-300 cursor-not-allowed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </span>
            @else
                <a href="{{ $faqs->previousPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" /></svg>
                </a>
            @endif

            @for($p = 1; $p <= $faqs->lastPage(); $p++)
                @if($p === $faqs->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#0b4d75] text-white text-sm font-bold">{{ $p }}</span>
                @else
                    <a href="{{ $faqs->url($p) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] text-sm transition">{{ $p }}</a>
                @endif
            @endfor

            @if($faqs->hasMorePages())
                <a href="{{ $faqs->nextPageUrl() }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-white border border-gray-200 hover:bg-blue-50 hover:border-[#0b4d75] text-gray-600 hover:text-[#0b4d75] transition">
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

{{-- MODAL KONFIRMASI HAPUS --}}
<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-red-600 p-5">
            <h3 class="text-white font-bold text-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                Hapus FAQ
            </h3>
        </div>
        <div class="p-6">
            <p class="text-gray-600 text-sm mb-1">Yakin ingin menghapus pertanyaan:</p>
            <p id="delete-question-text" class="font-bold text-gray-800 text-sm mb-6 italic">"..."</p>
            <p class="text-xs text-red-500 bg-red-50 border border-red-200 rounded-lg px-3 py-2 mb-6">⚠️ Data yang dihapus tidak dapat dikembalikan.</p>
            <div class="flex gap-3">
                <button type="button" onclick="closeDeleteModal()" id="btn-batal-hapus"
                    class="flex-1 py-2.5 rounded-xl border border-gray-300 text-gray-600 font-semibold text-sm hover:bg-gray-50 transition">
                    Batal
                </button>
                <form id="delete-form" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" id="btn-konfirmasi-hapus"
                        class="w-full py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold text-sm transition">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(id, question) {
        document.getElementById('delete-question-text').textContent = '"' + question + '"';
        document.getElementById('delete-form').action = '/admin-gsc/faq/' + id;
        document.getElementById('delete-modal').classList.remove('hidden');
        document.getElementById('delete-modal').classList.add('flex');
    }

    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
        document.getElementById('delete-modal').classList.remove('flex');
    }

    document.getElementById('delete-modal').addEventListener('click', function(e) {
        if (e.target === this) closeDeleteModal();
    });
</script>
@endpush

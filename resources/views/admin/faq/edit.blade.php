{{-- resources/views/admin/faq/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit FAQ - Admin OCTOBERUN 2026')

@section('content')

<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-black text-gray-900 tracking-tight">Edit FAQ</h1>

        </div>
        <a href="{{ route('admin.settings', ['tab' => 'faq']) }}"
            class="inline-flex items-center gap-2 text-sm font-semibold px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 hover:text-[#0b4d75] hover:border-[#0b4d75] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali
        </a>
    </div>
</div>

<div class="max-w-2xl">
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-6 py-4">
            <h2 class="text-white font-bold text-base flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                Edit Pertanyaan FAQ
            </h2>
        </div>

        <form method="POST" action="{{ route('admin.faq.update', $faq->id) }}" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Pertanyaan --}}
            <div>
                <label for="question" class="block text-sm font-bold text-gray-700 mb-2">
                    Pertanyaan <span class="text-red-500">*</span>
                </label>
                <textarea id="question" name="question" rows="3"
                    class="w-full border {{ $errors->has('question') ? 'border-red-400' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] resize-none"
                    placeholder="Tulis pertanyaan di sini...">{{ old('question', $faq->question) }}</textarea>
                @error('question')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jawaban --}}
            <div>
                <label for="answer" class="block text-sm font-bold text-gray-700 mb-2">
                    Jawaban <span class="text-red-500">*</span>
                </label>
                <textarea id="answer" name="answer" rows="5"
                    class="w-full border {{ $errors->has('answer') ? 'border-red-400' : 'border-gray-300' }} rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75] resize-none"
                    placeholder="Tulis jawaban di sini...">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Urutan & Status --}}
            <div class="grid grid-cols-2 gap-5">
                <div>
                    <label for="order" class="block text-sm font-bold text-gray-700 mb-2">Urutan</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $faq->order) }}" min="0"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0b4d75]/30 focus:border-[#0b4d75]">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                    <label class="flex items-center gap-3 cursor-pointer mt-2">
                        <div class="relative">
                            <input type="checkbox" id="is_active" name="is_active" value="1"
                                {{ old('is_active', $faq->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-checked:bg-[#0b4d75] rounded-full transition-colors duration-300"></div>
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-300 peer-checked:translate-x-5"></div>
                        </div>
                        <span id="toggle-label" class="text-sm font-semibold text-gray-700">
                            {{ old('is_active', $faq->is_active) ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </label>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex gap-3 pt-2 border-t border-gray-100">
                <button type="submit" id="btn-update-faq"
                    class="flex-1 bg-amber-500 hover:bg-amber-600 text-white font-bold py-3 rounded-xl transition text-sm">
                    Perbarui FAQ
                </button>
                <a href="{{ route('admin.settings', ['tab' => 'faq']) }}"
                    class="flex-1 text-center border border-gray-300 text-gray-600 font-semibold py-3 rounded-xl hover:bg-gray-50 transition text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const checkbox = document.getElementById('is_active');
    const label = document.getElementById('toggle-label');
    checkbox.addEventListener('change', () => {
        label.textContent = checkbox.checked ? 'Aktif' : 'Nonaktif';
    });
</script>
@endpush

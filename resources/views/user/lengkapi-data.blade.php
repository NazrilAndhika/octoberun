{{-- resources/views/user/lengkapi-data.blade.php --}}
@extends('layouts.user')

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20 font-sans">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Judul Halaman --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-[#0b4d75]">Pemutakhiran Data Peserta</h1>
            <p class="text-gray-500 mt-2">Lengkapi data keselamatan dan nama BIB Anda untuk persiapan Race Pack</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center shadow-sm mb-6">
                <div class="w-16 h-16 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-green-700 mb-2">{{ session('success') }}</h2>
                <p class="text-green-600 font-medium">Terima kasih telah memutakhirkan data pendaftaran Anda.</p>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center shadow-sm mb-6">
                <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="text-red-700 text-lg">{!! session('error') !!}</div>
            </div>
        @endif

        {{-- Form Pencarian --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
            <form action="{{ route('lengkapi-data') }}" method="GET">
                <label for="search" class="block text-sm font-bold text-gray-700 mb-2">
                    Cari data Anda (Email atau NIK)
                </label>
                <div class="flex gap-3">
                    <input type="text" name="search" id="search" 
                           class="flex-1 rounded-lg border-gray-300 focus:border-[#0b4d75] focus:ring-[#0b4d75] shadow-sm px-4 py-3 text-sm"
                           placeholder="Masukkan Email atau NIK..." 
                           value="{{ request('search') }}"
                           required>
                    <button type="submit" class="bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-300 text-sm uppercase">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        {{-- Hasil Pencarian --}}
        @if(request()->filled('search') && !session('success'))
            @if(isset($showListOnly) && $showListOnly)
                {{-- Tampilkan List Peserta --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
                    <h2 class="text-lg font-bold text-[#0b4d75] mb-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Pilih Data Peserta
                    </h2>
                    <p class="text-gray-500 text-sm mb-5">Ditemukan beberapa data peserta dengan email yang sama. Silakan pilih peserta yang ingin dilengkapi datanya:</p>
                    <div class="space-y-3">
                        @foreach($participants as $p)
                            <a href="{{ route('lengkapi-data', ['search' => request('search'), 'participant_id' => $p->id]) }}" class="block p-4 bg-gray-50 border border-gray-200 rounded-xl hover:bg-[#0b4d75] hover:text-white hover:border-[#0b4d75] transition group cursor-pointer shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-bold text-gray-900 group-hover:text-white text-lg">{{ $p->full_name }}</h3>
                                        <p class="text-xs text-gray-500 group-hover:text-gray-200 mt-1">
                                            <span class="font-semibold">Kategori:</span> {{ $p->category->name ?? 'N/A' }} <span class="mx-1">|</span>
                                            <span class="font-semibold">NIK:</span> {{ $p->id_number }}
                                        </p>
                                    </div>
                                    <div class="bg-white group-hover:bg-blue-800 p-2 rounded-full shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#0b4d75] group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @elseif($participants->isNotEmpty())
                <div class="space-y-6">
                @foreach($participants as $participant)
                    @if(request()->filled('participant_id'))
                        <div class="mb-2">
                            <a href="{{ route('lengkapi-data', ['search' => request('search')]) }}" class="inline-flex items-center text-sm font-bold text-gray-500 hover:text-[#0b4d75] transition bg-white py-2 px-4 rounded-lg border border-gray-200 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                </svg>
                                Kembali ke Daftar Peserta
                            </a>
                        </div>
                    @endif

                    @php
                        $isBibEmpty = is_null($participant->bib_name) || trim($participant->bib_name) === '-' || trim($participant->bib_name) === '';
                        $isBirthPlaceEmpty = is_null($participant->birth_place) || trim($participant->birth_place) === '-' || trim($participant->birth_place) === '';
                        $isBirthDateEmpty = empty($participant->birth_date);
                        $isContactNameEmpty = is_null($participant->emergency_contact_name) || trim($participant->emergency_contact_name) === '-' || trim($participant->emergency_contact_name) === '';
                        $isContactPhoneEmpty = is_null($participant->emergency_contact_phone) || trim($participant->emergency_contact_phone) === '-' || trim($participant->emergency_contact_phone) === '';
                        $isContactRelEmpty = is_null($participant->emergency_contact_relation) || trim($participant->emergency_contact_relation) === '-' || trim($participant->emergency_contact_relation) === '';
                        $isBloodEmpty = is_null($participant->blood_type) || trim($participant->blood_type) === '-' || trim($participant->blood_type) === '';
                        $isMedicalEmpty = is_null($participant->medical_history) || trim($participant->medical_history) === '-' || trim($participant->medical_history) === '';

                        // Cek apakah data ada yang kurang lengkap
                        $isIncomplete = $isContactNameEmpty || $isBibEmpty || $isBirthPlaceEmpty || $isBirthDateEmpty || $isBloodEmpty;
                    @endphp

                    @if($isIncomplete)
                        <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-yellow-400"></div>
                            
                            <div class="text-center mb-8 mt-2">
                                <div class="w-16 h-16 bg-yellow-50 text-yellow-500 rounded-full flex items-center justify-center mx-auto mb-4 border border-yellow-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <h2 class="text-lg font-black text-gray-900 tracking-tight mb-2">Data Belum Lengkap!</h2>
                                <p class="text-gray-500 text-sm max-w-md mx-auto">Halo <strong>{{ $participant->full_name }}</strong>, kami butuh tambahan Data Keselamatan & Nama BIB kamu untuk persiapan Race Pack.</p>
                            </div>

                            @if($errors->any())
                                <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6">
                                    <ul class="list-disc list-inside text-red-600 text-sm space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('lengkapi-data.store', $participant->id) }}" method="POST" class="space-y-6">
                                @csrf

                                {{-- NAMA BIB & TANGGAL LAHIR --}}
                                @if($isBibEmpty || $isBirthPlaceEmpty || $isBirthDateEmpty)
                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 space-y-5">
                                    @if($isBibEmpty)
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1.5">
                                            Nama pada BIB <span class="text-red-500">*</span>
                                        </label>
                                        <p class="text-xs text-gray-400 mb-3">Maksimal 10 huruf. Akan dicetak pada nomor lari (BIB) Anda.</p>
                                        <input type="text" name="bib_name" value="{{ old('bib_name') }}" maxlength="10" placeholder="Contoh: BUDI" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-4 py-2.5 text-sm uppercase" required>
                                    </div>
                                    @else
                                    <input type="hidden" name="bib_name" value="{{ $participant->bib_name }}">
                                    @endif
                                    
                                    @if($isBirthPlaceEmpty || $isBirthDateEmpty)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @if($isBirthPlaceEmpty)
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1.5">
                                                Tempat Lahir <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="birth_place" value="{{ old('birth_place') }}" placeholder="Masukkan tempat lahir" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2.5 text-sm" required>
                                        </div>
                                        @else
                                        <input type="hidden" name="birth_place" value="{{ $participant->birth_place }}">
                                        @endif

                                        @if($isBirthDateEmpty)
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1.5">
                                                Tanggal Lahir <span class="text-red-500">*</span>
                                            </label>
                                            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-[#0b4d75] focus:ring-[#0b4d75] px-3 py-2.5 text-sm" required>
                                        </div>
                                        @else
                                        <input type="hidden" name="birth_date" value="{{ $participant->birth_date }}">
                                        @endif
                                    </div>
                                    @else
                                    <input type="hidden" name="birth_place" value="{{ $participant->birth_place }}">
                                    <input type="hidden" name="birth_date" value="{{ $participant->birth_date }}">
                                    @endif
                                </div>
                                @else
                                <input type="hidden" name="bib_name" value="{{ $participant->bib_name }}">
                                <input type="hidden" name="birth_place" value="{{ $participant->birth_place }}">
                                <input type="hidden" name="birth_date" value="{{ $participant->birth_date }}">
                                @endif

                                {{-- EMERGENCY CONTACT --}}
                                @if($isContactNameEmpty || $isContactPhoneEmpty || $isContactRelEmpty || $isBloodEmpty || $isMedicalEmpty)
                                <div class="bg-red-50 p-5 rounded-xl border border-red-100">
                                    <h3 class="font-bold text-red-700 text-sm uppercase tracking-wider mb-4 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Emergency Contact & Medis
                                    </h3>
                                    
                                    <div class="space-y-4">
                                        @if($isContactNameEmpty)
                                        <div>
                                            <label class="block text-xs font-bold text-gray-700 mb-1">Nama Kontak Darurat <span class="text-red-500">*</span></label>
                                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 text-sm" required>
                                        </div>
                                        @else
                                        <input type="hidden" name="emergency_contact_name" value="{{ $participant->emergency_contact_name }}">
                                        @endif

                                        @if($isContactPhoneEmpty || $isContactRelEmpty)
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @if($isContactPhoneEmpty)
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 mb-1">No. HP Darurat <span class="text-red-500">*</span></label>
                                                <input type="number" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 text-sm" required>
                                            </div>
                                            @else
                                            <input type="hidden" name="emergency_contact_phone" value="{{ $participant->emergency_contact_phone }}">
                                            @endif

                                            @if($isContactRelEmpty)
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 mb-1">Hubungan <span class="text-red-500">*</span></label>
                                                <select name="emergency_contact_relation" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 text-sm" required>
                                                    <option value="" disabled selected>Pilih...</option>
                                                    @foreach(['Orang Tua', 'Suami/Istri', 'Saudara', 'Teman/Lainnya'] as $relasi)
                                                        <option value="{{ $relasi }}" {{ old('emergency_contact_relation') === $relasi ? 'selected' : '' }}>{{ $relasi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <input type="hidden" name="emergency_contact_relation" value="{{ $participant->emergency_contact_relation }}">
                                            @endif
                                        </div>
                                        @else
                                        <input type="hidden" name="emergency_contact_phone" value="{{ $participant->emergency_contact_phone }}">
                                        <input type="hidden" name="emergency_contact_relation" value="{{ $participant->emergency_contact_relation }}">
                                        @endif

                                        @if($isBloodEmpty || $isMedicalEmpty)
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            @if($isBloodEmpty)
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 mb-1">Golongan Darah <span class="text-red-500">*</span></label>
                                                <select name="blood_type" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 text-sm" required>
                                                    <option value="" disabled selected>Pilih...</option>
                                                    @foreach(['A','B','AB','O','Tidak Tahu'] as $goldar)
                                                        <option value="{{ $goldar }}" {{ old('blood_type') === $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @else
                                            <input type="hidden" name="blood_type" value="{{ $participant->blood_type }}">
                                            @endif

                                            @if($isMedicalEmpty)
                                            <div>
                                                <label class="block text-xs font-bold text-gray-700 mb-1">Riwayat Penyakit <span class="text-red-500">*</span></label>
                                                <input type="text" name="medical_history" value="{{ old('medical_history') }}" placeholder="Ketik 'Tidak Ada' jika sehat" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500 px-3 py-2 text-sm" required>
                                            </div>
                                            @else
                                            <input type="hidden" name="medical_history" value="{{ $participant->medical_history }}">
                                            @endif
                                        </div>
                                        @else
                                        <input type="hidden" name="blood_type" value="{{ $participant->blood_type }}">
                                        <input type="hidden" name="medical_history" value="{{ $participant->medical_history }}">
                                        @endif
                                    </div>
                                </div>
                                @else
                                <input type="hidden" name="emergency_contact_name" value="{{ $participant->emergency_contact_name }}">
                                <input type="hidden" name="emergency_contact_phone" value="{{ $participant->emergency_contact_phone }}">
                                <input type="hidden" name="emergency_contact_relation" value="{{ $participant->emergency_contact_relation }}">
                                <input type="hidden" name="blood_type" value="{{ $participant->blood_type }}">
                                <input type="hidden" name="medical_history" value="{{ $participant->medical_history }}">
                                @endif

                                <button type="submit" class="w-full bg-[#0b4d75] hover:bg-blue-800 text-white font-bold py-3.5 px-6 rounded-xl shadow-md transition uppercase tracking-widest text-sm flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                    Simpan Data
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="bg-green-50 border border-green-200 rounded-2xl p-6 text-center shadow-sm">
                            <div class="w-16 h-16 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-green-700 mb-2">Data Sudah Lengkap & Terverifikasi</h2>
                            <p class="text-green-600 font-medium">Halo {{ $participant->full_name }}, data kamu sudah lengkap. Sampai jumpa di hari H!</p>
                        </div>
                    @endif
                @endforeach
                </div>
            @else
                <div class="bg-red-50 border border-red-200 rounded-2xl p-6 text-center shadow-sm">
                    <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-red-700 mb-2">Data Tidak Ditemukan</h2>
                    <p class="text-red-600">Maaf, kami tidak menemukan pendaftar dengan NIK atau email tersebut. Pastikan ejaan yang kamu masukkan sudah benar.</p>
                </div>
            @endif
        @endif

    </div>
</div>
@endsection

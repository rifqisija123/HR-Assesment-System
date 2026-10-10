@extends('layouts.candidate')

@section('title', 'Petunjuk Pelaksanaan Asesmen')

@section('content')
<div class="min-h-screen flex flex-col bg-[#F8FAFC]">
    <!-- Top Navigation Header -->
    <header class="h-[72px] bg-white border-b border-[#E2E8F0] px-6 md:px-12 flex items-center justify-between shrink-0">
        <!-- Brand & Page Title -->
        <div class="flex items-center gap-3.5">
            <div class="w-[38px] h-[38px] rounded-[10px] bg-[#147D92] flex items-center justify-center shrink-0">
                <span class="font-sans font-extrabold text-white text-[19px] leading-none">V</span>
            </div>
            <div class="flex flex-col">
                <span class="font-sans font-bold text-[#0F172A] text-base leading-5 tracking-[-0.02em]">Verta Assess</span>
                <span class="font-sans font-medium text-[#64748B] text-xs leading-4">Petunjuk Pelaksanaan Asesmen</span>
            </div>
        </div>

        <!-- Verified Candidate Pill -->
        <div class="flex items-center gap-3 px-3.5 py-1.5 rounded-full bg-[#F1F5F9] border border-[#E2E8F0]">
            <div class="w-7 h-7 rounded-full bg-[#0E6273] flex items-center justify-center shrink-0">
                <span class="font-sans font-bold text-white text-xs leading-4">AF</span>
            </div>
            <div class="flex flex-col">
                <span class="font-sans font-bold text-[#0F172A] text-[12.5px] leading-4">Ahmad Fauzi</span>
                <span class="font-sans text-[#64748B] text-[11px] leading-3.5">ahmad.fauzi@example.com</span>
            </div>
            <div class="px-2 py-0.5 rounded-[10px] bg-[#DCFCE7] border border-[#86EFAC]">
                <span class="font-sans font-bold text-[#15803D] text-[10px] leading-3 uppercase tracking-wide">
                    KANDIDAT TERVERIFIKASI
                </span>
            </div>
        </div>
    </header>

    <!-- Main Content Body -->
    <main class="flex-1 flex flex-col items-center py-7 px-6 md:px-12 gap-5 overflow-y-auto">
        
        <!-- Card 1: Active Test Package Summary -->
        <div class="w-full max-w-[1040px] bg-white rounded-[14px] border border-[#E2E8F0] shadow-[0_4px_12px_rgba(16,42,67,0.04)] p-6 md:px-7 md:py-6 flex flex-col gap-4">
            <!-- Top Row: Package Info & Attempt Limit Badge -->
            <div class="flex flex-col md:flex-row items-start justify-between gap-4">
                <div class="flex flex-col gap-1">
                    <div class="flex items-center gap-2">
                        <span class="px-2 py-0.75 py-0.5 rounded-md bg-[#E6F6F8] text-[#147D92] font-sans font-bold text-[11px] leading-3.5 uppercase tracking-[0.05em]">
                            Paket Ujian Aktif
                        </span>
                        <span class="font-sans text-[#64748B] text-xs leading-4">
                            • PT Verta Digital Solusindo
                        </span>
                    </div>
                    <h1 class="font-sans font-bold text-[#0F172A] text-xl leading-6 tracking-[-0.01em] m-0">
                        Technical Assessment — Senior Backend Engineer
                    </h1>
                    <p class="font-sans text-[#475569] text-[13px] leading-4 m-0">
                        Sesi rekrutmen gelombang 4 mencakup evaluasi arsitektur sistem backend, optimasi database MySQL, API design, dan logic problem solving.
                    </p>
                </div>

                <!-- Attempt Badge -->
                <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#FEF3C7] border border-[#FDE68A] shrink-0">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span class="font-sans font-semibold text-[#B45309] text-xs leading-4">
                        1x Percobaan (Attempt)
                    </span>
                </div>
            </div>

            <!-- Bottom Row: 4 Metric Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3.5 pt-3.5 border-t border-[#F1F5F9]">
                <!-- Metric 1: Durasi -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3 md:px-4 md:py-3 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-[#E0F2FE] flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0284C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-sans font-medium text-[#64748B] text-[11px] leading-3.5">Durasi Ujian</span>
                        <span class="font-sans font-bold text-[#0F172A] text-[15px] leading-[18px]">90 Menit</span>
                    </div>
                </div>

                <!-- Metric 2: Total Soal -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3 md:px-4 md:py-3 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-[#EDE9FE] flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#7C3AED" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-sans font-medium text-[#64748B] text-[11px] leading-3.5">Total Soal</span>
                        <span class="font-sans font-bold text-[#0F172A] text-[15px] leading-[18px]">25 Soal (20 PG + 5 Essay)</span>
                    </div>
                </div>

                <!-- Metric 3: Passing Grade -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3 md:px-4 md:py-3 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-[#DCFCE7] flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-sans font-medium text-[#64748B] text-[11px] leading-3.5">Ambang Kelulusan</span>
                        <span class="font-sans font-bold text-[#0F172A] text-[15px] leading-[18px]">Passing Grade: 75%</span>
                    </div>
                </div>

                <!-- Metric 4: Batas Waktu -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3 md:px-4 md:py-3 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-[#FEF3C7] flex items-center justify-center shrink-0">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-sans font-medium text-[#64748B] text-[11px] leading-3.5">Batas Waktu Sesi</span>
                        <span class="font-sans font-bold text-[#0F172A] text-[15px] leading-[18px]">Hari ini, 18:00 WIB</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card 2: Regulations & Rules Grid -->
        <div class="w-full max-w-[1040px] bg-white rounded-[14px] border border-[#E2E8F0] shadow-[0_4px_12px_rgba(16,42,67,0.04)] p-5 md:px-7 md:py-5.5 flex flex-col gap-4">
            <h2 class="font-sans font-bold text-[#0F172A] text-[15px] leading-[18px] m-0">
                Peraturan & Tata Tertib Pengerjaan Tes
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3.5">
                <!-- Rule 1 -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3.5 md:p-4 flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-md bg-[#147D92] flex items-center justify-center shrink-0">
                            <span class="font-sans font-bold text-white text-xs leading-4">1</span>
                        </div>
                        <span class="font-sans font-bold text-[#0F172A] text-[13px] leading-4">
                            Penyimpanan Otomatis
                        </span>
                    </div>
                    <p class="font-sans text-[#64748B] text-xs leading-[18px] m-0">
                        Jawaban tersimpan otomatis secara real-time ke server saat berpindah soal atau mengisi input teks.
                    </p>
                </div>

                <!-- Rule 2 -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3.5 md:p-4 flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-md bg-[#147D92] flex items-center justify-center shrink-0">
                            <span class="font-sans font-bold text-white text-xs leading-4">2</span>
                        </div>
                        <span class="font-sans font-bold text-[#0F172A] text-[13px] leading-4">
                            Navigasi Soal Bebas
                        </span>
                    </div>
                    <p class="font-sans text-[#64748B] text-xs leading-[18px] m-0">
                        Anda bebas melompati soal, menandai nomor ragu-ragu, dan mengubah jawaban sebelum menekan submit.
                    </p>
                </div>

                <!-- Rule 3 -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3.5 md:p-4 flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-md bg-[#147D92] flex items-center justify-center shrink-0">
                            <span class="font-sans font-bold text-white text-xs leading-4">3</span>
                        </div>
                        <span class="font-sans font-bold text-[#0F172A] text-[13px] leading-4">
                            Timer Server-Side
                        </span>
                    </div>
                    <p class="font-sans text-[#64748B] text-xs leading-[18px] m-0">
                        Countdown timer dimulai saat menekan tombol Mulai. Jika waktu habis, sistem otomatis mengumpulkan jawaban.
                    </p>
                </div>

                <!-- Rule 4 -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[10px] p-3.5 md:p-4 flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-md bg-[#147D92] flex items-center justify-center shrink-0">
                            <span class="font-sans font-bold text-white text-xs leading-4">4</span>
                        </div>
                        <span class="font-sans font-bold text-[#0F172A] text-[13px] leading-4">
                            Pengiriman Final
                        </span>
                    </div>
                    <p class="font-sans text-[#64748B] text-xs leading-[18px] m-0">
                        Setelah tombol Kumpulkan ditekan & dikonfirmasi, sesi terkunci permanen dan masuk ke antrean penilaian.
                    </p>
                </div>
            </div>
        </div>

        <!-- Card 3: Agreement Checkbox & Start Action -->
        <div x-data="{ agreed: true }" class="w-full max-w-[1040px] bg-white rounded-[14px] border border-[#E2E8F0] shadow-[0_4px_12px_rgba(16,42,67,0.04)] p-4 md:px-7 md:py-4.5 flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Left: Checkbox Agreement -->
            <label class="flex items-center gap-3 cursor-pointer select-none">
                <input type="checkbox" x-model="agreed" class="hidden">
                <div 
                    :class="agreed ? 'bg-[#147D92] border-[#147D92]' : 'bg-white border-[#CBD5E1]'"
                    class="w-[22px] h-[22px] rounded-md border flex items-center justify-center shrink-0 transition-colors"
                >
                    <svg x-show="agreed" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <span class="font-sans font-semibold text-[#1E293B] text-[13px] leading-4">
                    Saya menyatakan siap mengikuti tes ini dengan jujur dan memahami seluruh petunjuk pengerjaan di atas.
                </span>
            </label>

            <!-- Right: Action Buttons -->
            <div class="flex items-center gap-3.5 shrink-0 w-full sm:w-auto justify-end">
                <a 
                    href="{{ url('/candidate') }}" 
                    class="px-4.5 py-2.5 rounded-[9px] border border-[#CBD5E1] bg-white hover:bg-[#F8FAFC] text-[#64748B] font-sans font-semibold text-[13.5px] leading-[18px] transition-colors no-underline text-center"
                >
                    Keluar
                </a>

                <a 
                    href="{{ url('/candidate/exam') }}" 
                    :class="agreed ? 'bg-[#147D92] hover:bg-[#0E6273] opacity-100 cursor-pointer shadow-[0_4px_14px_rgba(20,125,146,0.3)]' : 'bg-[#94A3B8] opacity-60 cursor-not-allowed shadow-none'"
                    class="flex items-center gap-2 px-6 py-2.5 rounded-[9px] text-white font-sans font-bold text-sm leading-[18px] transition-all no-underline text-center"
                    :disabled="!agreed"
                >
                    <span>Mulai Pengerjaan Ujian</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>

    </main>
</div>
@endsection

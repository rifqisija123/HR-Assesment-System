@extends('layouts.candidate')

@section('title', 'Masuk Sesi Asesmen - Verifikasi Token')

@section('content')
<div class="min-h-screen flex flex-col bg-[#F8FAFC]">
    <!-- Top Navigation Header -->
    <header class="h-[72px] bg-white border-b border-[#E2E8F0] px-6 md:px-12 flex items-center justify-between shrink-0">
        <!-- Brand & System Status -->
        <div class="flex items-center gap-3.5">
            <div class="w-[38px] height-[38px] h-[38px] rounded-[10px] bg-[#147D92] flex items-center justify-center shrink-0">
                <span class="font-sans font-extrabold text-white text-[19px] leading-none">V</span>
            </div>
            <div class="flex flex-col">
                <span class="font-sans font-bold text-[#0F172A] text-base leading-5 tracking-[-0.02em]">Verta Assess</span>
                <span class="font-sans font-medium text-[#64748B] text-xs leading-4">Candidate Assessment Portal</span>
            </div>
            <div class="hidden sm:block w-px h-6 bg-[#E2E8F0] mx-2"></div>
            <div class="hidden sm:flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#ECFDF5] border border-[#A7F3D0]">
                <div class="w-[7px] h-[7px] rounded-full bg-[#10B981] shrink-0"></div>
                <span class="font-sans font-semibold text-[#047857] text-[11px] leading-3.5">Sistem Online & Terkoneksi</span>
            </div>
        </div>

        <!-- Meta Information & Support -->
        <div class="flex items-center gap-3 md:gap-4">
            <div class="hidden md:flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#F1F5F9]">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                <span class="font-sans font-medium text-[#475569] text-xs leading-4">Zona Waktu: Asia/Jakarta (WIB)</span>
            </div>
            <a href="#" class="flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-[#F8FAFC] border border-[#E2E8F0] hover:bg-[#F1F5F9] transition-colors no-underline">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
                <span class="font-sans font-semibold text-[#334155] text-xs leading-4">Bantuan Teknis</span>
            </a>
        </div>
    </header>

    <!-- Main Content Area: Centered Card -->
    <main class="flex-1 flex items-center justify-center p-4 md:p-8">
        <div class="w-full max-w-[560px] bg-white rounded-2xl border border-[#E2E8F0] shadow-[0_10px_25px_-5px_rgba(16,42,67,0.08)] p-7 md:p-10 flex flex-col gap-6">
            
            <!-- Card Header Icon & Headline -->
            <div class="flex flex-col items-center text-center gap-2.5">
                <div class="w-14 h-14 rounded-2xl bg-[#E6F6F8] flex items-center justify-center shrink-0 mb-1">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                    </svg>
                </div>
                <h1 class="font-sans font-bold text-[#0F172A] text-[22px] md:text-2xl leading-7 tracking-[-0.02em] m-0">
                    Masuk Sesi Asesmen
                </h1>
                <p class="font-sans text-[#64748B] text-[13.5px] leading-5 max-w-[440px] m-0">
                    Masukkan token asesmen resmi yang telah dikirimkan ke email Anda untuk memulai proses tes mandiri.
                </p>
            </div>

            <!-- Session Details Preview Box -->
            <div class="bg-[#F0FDF4] border border-[#BBF7D0] rounded-[10px] p-3.5 md:p-4 flex flex-col gap-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1.5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#15803D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                        </svg>
                        <span class="font-sans font-bold text-[#166534] text-xs leading-4 uppercase tracking-[0.04em]">
                            PT Verta Digital Solusindo
                        </span>
                    </div>
                    <span class="bg-[#DCFCE7] text-[#15803D] font-sans font-semibold text-[11px] leading-3.5 px-2 py-0.5 rounded-full">
                        Sesi Dibuka
                    </span>
                </div>
                <div class="flex flex-col gap-0.5">
                    <span class="font-sans font-semibold text-[#14532D] text-sm leading-[18px]">
                        Rekrutmen Tech Talent 2026 — Batch IV
                    </span>
                    <span class="font-sans text-[#166534] text-xs leading-4">
                        Jadwal: 24 September 2026 • 14:00 - 18:00 WIB
                    </span>
                </div>
            </div>

            <!-- Form Fields -->
            <form action="{{ url('/candidate/instruction') }}" method="GET" class="flex flex-col gap-4.5 space-y-4.5">
                @csrf
                <!-- Email Input Field -->
                <div class="flex flex-col gap-1.5">
                    <div class="flex items-center justify-between">
                        <label for="email" class="font-sans font-semibold text-[#334155] text-[13px] leading-4">
                            Alamat Email Terdaftar
                        </label>
                        <span class="font-sans text-[#64748B] text-[11px] leading-3.5">
                            Sesuai undangan HR
                        </span>
                    </div>
                    <div class="h-11 px-3.5 rounded-[9px] border-[1.5px] border-[#CBD5E1] bg-white flex items-center gap-2.5 focus-within:border-[#147D92] focus-within:ring-2 focus-within:ring-[#147D92]/15 transition-all">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="ahmad.fauzi@example.com" 
                            placeholder="nama@email.com" 
                            required
                            class="w-full bg-transparent border-none text-[#0F172A] font-sans font-medium text-sm focus:outline-none placeholder:text-[#94A3B8]"
                        >
                    </div>
                </div>

                <!-- Token Input Field -->
                <div class="flex flex-col gap-1.5">
                    <div class="flex items-center justify-between">
                        <label for="token" class="font-sans font-semibold text-[#334155] text-[13px] leading-4">
                            Token Akses Ujian
                        </label>
                        <span class="font-sans font-semibold text-[#147D92] text-[11px] leading-3.5">
                            Format: 12 Karakter Unik
                        </span>
                    </div>
                    <div class="h-12 px-3.5 rounded-[9px] border-2 border-[#147D92] bg-[#F8FAFC] shadow-[0_0_0_3px_rgba(20,125,146,0.12)] flex items-center justify-between gap-2.5 focus-within:ring-2 focus-within:ring-[#147D92]/20 transition-all">
                        <div class="flex items-center gap-2.5 flex-1">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                                <path d="M21 2l-2 2m-1.5 1.5L16 7l-1.5-1.5M7 13l-4 4v4h4l4-4m-4-4l7-7a2.828 2.828 0 1 1 4 4l-7 7Z"></path>
                            </svg>
                            <input 
                                type="text" 
                                id="token" 
                                name="token" 
                                value="VRTA-8921-TK48" 
                                placeholder="XXXX-XXXX-XXXX" 
                                required
                                class="w-full bg-transparent border-none text-[#0F172A] font-mono font-bold text-base tracking-[0.15em] uppercase focus:outline-none placeholder:text-[#94A3B8]"
                            >
                        </div>
                        <div class="bg-[#E0F2FE] rounded-md px-2 py-0.75 py-1 flex items-center gap-1 shrink-0">
                            <span class="font-sans font-semibold text-[#0369A1] text-[11px] leading-3.5">
                                Token Valid
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-3 pt-2">
                    <button 
                        type="submit" 
                        class="w-full h-[46px] bg-[#147D92] hover:bg-[#0E6273] active:bg-[#0b4e5c] text-white font-sans font-bold text-sm rounded-[10px] flex items-center justify-center gap-2 shadow-[0_4px_12px_rgba(20,125,146,0.25)] transition-all cursor-pointer border-none"
                    >
                        <span>Verifikasi & Lanjutkan ke Petunjuk</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>

                    <!-- Security Badge -->
                    <div class="flex items-center justify-center gap-1.5 text-center">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <span class="font-sans text-[#64748B] text-[11.5px] leading-3.5">
                            Sesi dilindungi enkripsi end-to-end dan verifikasi token tunggal.
                        </span>
                    </div>
                </div>
            </form>

        </div>
    </main>
</div>
@endsection

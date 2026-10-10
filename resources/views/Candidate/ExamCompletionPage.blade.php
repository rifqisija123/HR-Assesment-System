@extends('layouts.candidate')

@section('title', 'Ujian Selesai — Technical Assessment')

@section('content')
<div class="min-h-screen flex flex-col bg-[#F8FAFC] text-[#0F172A]">

    <!-- Top Header Bar -->
    <header class="h-[72px] bg-white border-b border-[#E2E8F0] px-6 md:px-12 flex items-center justify-between shrink-0">
        <!-- Left: Brand -->
        <div class="flex items-center gap-3">
            <div class="w-[40px] h-[40px] rounded-[10px] bg-[#147D92] flex items-center justify-center shrink-0 shadow-inner">
                <span class="font-sans font-extrabold text-white text-[20px] leading-none">V</span>
            </div>
            <div class="flex flex-col">
                <span class="font-sans font-bold text-[#0F172A] text-[15px] leading-[18px] tracking-[-0.01em]">Verta Assess</span>
                <span class="font-sans text-[#94A3B8] text-[12.5px] leading-4">Candidate Assessment Portal</span>
            </div>
        </div>

        <!-- Right: Status Badge -->
        <div class="hidden sm:flex items-center gap-2 bg-[#ECFDF5] border border-[#A7F3D0] rounded-full px-4 py-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                <polyline points="20 6 9 17 4 12" stroke="#10B981" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="font-sans font-semibold text-[#047857] text-[12px] leading-4 uppercase tracking-wider">Asesmen Selesai & Tersimpan</span>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 flex items-center justify-center px-4 py-8 sm:py-12">

        <!-- Single Card -->
        <div class="w-full max-w-[660px] bg-white border border-[#E2E8F0] rounded-[20px] shadow-[0_8px_30px_rgba(15,23,42,0.06)] p-7 sm:p-10 flex flex-col items-center gap-6">

            <!-- Checkmark Circle -->
            <div class="w-[64px] h-[64px] rounded-full bg-[#ECFDF5] border-2 border-[#6EE7B7] flex items-center justify-center shrink-0">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <polyline points="20 6 9 17 4 12" stroke="#10B981" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <!-- Title & Subtitle -->
            <div class="flex flex-col items-center gap-2 text-center">
                <h1 class="font-sans font-extrabold text-[#0F172A] text-[22px] leading-7 tracking-[-0.02em] m-0">
                    Ujian Asesmen Berhasil Dikirimkan!
                </h1>
                <p class="font-sans text-[#64748B] text-[13.5px] leading-[22px] max-w-[500px] m-0">
                    Terima kasih telah menyelesaikan seluruh rangkaian tes teknis untuk posisi<br>
                    <strong class="text-[#475569]">Senior Backend Engineer</strong> di <strong class="text-[#475569]">PT Verta Digital Solusindo</strong>.
                </p>
            </div>

            <!-- Info Table -->
            <div class="w-full border border-[#E2E8F0] rounded-[12px] overflow-hidden">
                <!-- Row 1 -->
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-[#F1F5F9]">
                    <span class="font-sans text-[#64748B] text-[13px] leading-4">Nomor Percobaan (Attempt ID)</span>
                    <span class="font-mono font-bold text-[#0F172A] text-[13px] leading-4">#ATT-20260924-8831</span>
                </div>
                <!-- Row 2 -->
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-[#F1F5F9]">
                    <span class="font-sans text-[#64748B] text-[13px] leading-4">Nama Kandidat</span>
                    <span class="font-sans font-semibold text-[#0F172A] text-[13px] leading-4">Ahmad Fauzi (ahmad.fauzi@example.com)</span>
                </div>
                <!-- Row 3 -->
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-[#F1F5F9]">
                    <span class="font-sans text-[#64748B] text-[13px] leading-4">Waktu Pengumpulan</span>
                    <span class="font-sans font-semibold text-[#0F172A] text-[13px] leading-4">24 September 2026 • 16:15:28 WIB</span>
                </div>
                <!-- Row 4 -->
                <div class="flex items-center justify-between px-5 py-3.5 border-b border-[#F1F5F9]">
                    <span class="font-sans text-[#64748B] text-[13px] leading-4">Durasi Pengerjaan</span>
                    <span class="font-sans font-semibold text-[#0F172A] text-[13px] leading-4">1 Jam 15 Menit 28 Detik</span>
                </div>
                <!-- Row 5 -->
                <div class="flex items-center justify-between px-5 py-3.5">
                    <span class="font-sans text-[#64748B] text-[13px] leading-4">Status Penilaian</span>
                    <div class="flex items-center gap-1.5">
                        <div class="w-2 h-2 rounded-full bg-[#F59E0B]"></div>
                        <span class="font-sans font-semibold text-[#D97706] text-[13px] leading-4">Menunggu Penilaian Jawaban Essay</span>
                    </div>
                </div>
            </div>

            <!-- Tahapan Selanjutnya Info Box -->
            <div class="w-full bg-[#F0FDF4] border border-[#BBF7D0] rounded-[12px] p-5 flex flex-col gap-3">
                <div class="flex items-center gap-2">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                        <circle cx="12" cy="12" r="10" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="12" y1="16" x2="12" y2="12" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="12" y1="8" x2="12.01" y2="8" stroke="#16A34A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-sans font-bold text-[#15803D] text-[13px] leading-4">Tahapan Selanjutnya:</span>
                </div>

                <ul class="font-sans text-[#166534] text-[12.5px] leading-[20px] m-0 pl-5 flex flex-col gap-1 list-disc">
                    <li>Jawaban pilihan ganda Anda telah dikalkulasi secara otomatis oleh sistem.</li>
                    <li>Jawaban essay teknis akan diperiksa oleh Reviewer Tim Engineering dalam <strong>1-2 hari kerja</strong>.</li>
                    <li>Pengumuman hasil akhir asesmen akan dikirimkan langsung ke email Anda.</li>
                </ul>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center gap-3 flex-wrap pt-1">
                <button 
                    type="button"
                    onclick="window.print()"
                    class="bg-white border-[1.5px] border-[#CBD5E1] hover:bg-[#F8FAFC] rounded-[10px] h-[44px] px-5 text-[#475569] font-sans font-semibold text-[13px] leading-4 transition-colors cursor-pointer flex items-center gap-2 justify-center"
                >
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <polyline points="7 10 12 15 17 10" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="12" y1="15" x2="12" y2="3" stroke="#475569" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Unduh Bukti Pengiriman (PDF)</span>
                </button>
                <a 
                    href="{{ url('/candidate') }}"
                    class="bg-[#147D92] hover:bg-[#0E6273] active:bg-[#0A4D5A] text-white rounded-[10px] h-[44px] px-6 font-sans font-bold text-[13px] leading-4 shadow-[0_4px_14px_rgba(20,125,146,0.25)] transition-all cursor-pointer flex items-center justify-center no-underline"
                >
                    Selesai & Keluar
                </a>
            </div>

        </div>
    </main>

</div>
@endsection

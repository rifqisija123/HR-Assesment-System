@extends('layouts.hradmin')

@section('title', 'Ringkasan')
@section('page_title', 'Ringkasan')

@section('content')
<div class="flex justify-between items-end gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-bold tracking-[0.06em]">
      OPERASIONAL ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[32px]/[38px] font-[750] tracking-[-0.035em]">
      Selamat pagi, Nadia
    </div>
    <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
      Pantau sesi aktif, progres kandidat, dan hasil asesmen hari ini.
    </div>
  </div>
</div>

<div class="flex gap-4">
  <!-- Card 1 -->
  <div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] flex-1 gap-[18px] p-[18px]">
    <div class="flex justify-between items-start">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium">
        Sesi aktif
      </div>
      <div class="flex items-center justify-center bg-[#E2F4F3] rounded-[9px] shrink-0 h-[34px] w-[34px]">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <rect x="3" y="4" width="18" height="17" rx="2" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M16 2v4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8 2v4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M3 10h18" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
    <div class="flex flex-col gap-1.25">
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[28px]/[32px] font-[750] tracking-[-0.03em]">
        4
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        2 sesi dimulai hari ini
      </div>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] flex-1 gap-[18px] p-[18px]">
    <div class="flex justify-between items-start">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium">
        Kandidat terdaftar
      </div>
      <div class="flex items-center justify-center bg-[#E7F6EE] rounded-[9px] shrink-0 h-[34px] w-[34px]">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <circle cx="9" cy="7" r="4" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M19 8v6" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M22 11h-6" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
    <div class="flex flex-col gap-1.25">
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[28px]/[32px] font-[750] tracking-[-0.03em]">
        128
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        36 sedang mengerjakan
      </div>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] flex-1 gap-[18px] p-[18px]">
    <div class="flex justify-between items-start">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium">
        Menunggu penilaian
      </div>
      <div class="flex items-center justify-center bg-[#FFF3DF] rounded-[9px] shrink-0 h-[34px] w-[34px]">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M12 8v4l3 2" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <circle cx="12" cy="12" r="9" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
    <div class="flex flex-col gap-1.25">
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[28px]/[32px] font-[750] tracking-[-0.03em]">
        19
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        Jawaban essay perlu direview
      </div>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] flex-1 gap-[18px] p-[18px]">
    <div class="flex justify-between items-start">
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium">
        Bank soal
      </div>
      <div class="flex items-center justify-center bg-[#EFE9FB] rounded-[9px] shrink-0 h-[34px] w-[34px]">
        <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <rect x="4" y="3" width="16" height="18" rx="2" fill="none" stroke="#7257B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8 7h8" fill="none" stroke="#7257B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8 11h8" fill="none" stroke="#7257B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8 15h5" fill="none" stroke="#7257B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
    </div>
    <div class="flex flex-col gap-1.25">
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[28px]/[32px] font-[750] tracking-[-0.03em]">
        246
      </div>
      <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
        12 soal ditambahkan bulan ini
      </div>
    </div>
  </div>
</div>

<div class="flex gap-[18px]">
  <!-- Sesi yang berjalan -->
  <div class="flex flex-col bg-white border border-[#DDE6ED] rounded-[14px] flex-[1.4] overflow-hidden">
    <div class="flex justify-between items-start border-b border-[#EDF2F5] pt-5 pb-4 px-[22px]">
      <div class="flex flex-col gap-1.25">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[17px]/[23px] font-bold tracking-[-0.015em]">
          Sesi yang berjalan
        </div>
        <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[13px]/[18px]">
          Pantau progres kandidat secara langsung.
        </div>
      </div>
      <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] cursor-pointer hover:underline">
        Lihat sesi &rarr;
      </div>
    </div>
    
    <div class="flex flex-col flex-1 px-[22px]">
      <!-- Sesi Item 1 -->
      <div class="flex items-center border-b border-[#EDF2F5] shrink-0 gap-3 h-16">
        <div class="flex items-center justify-center bg-[#E2F4F3] rounded-[9px] shrink-0 h-[34px] w-[34px]">
          <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold">
            LT
          </div>
        </div>
        <div class="flex flex-col flex-1 gap-[3px] min-w-0">
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
            Leadership Trainee &mdash; Batch 08
          </div>
          <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
            24 dari 32 kandidat &middot; berakhir 16.00
          </div>
        </div>
        <div class="flex items-center bg-[#E7F6EE] rounded-xl shrink-0 gap-1.5 h-6 px-[9px]">
          <div class="bg-[#198754] rounded-[3px] shrink-0 h-1.5 w-1.5"></div>
          <div class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">
            Aktif
          </div>
        </div>
      </div>

      <!-- Sesi Item 2 -->
      <div class="flex items-center border-b border-[#EDF2F5] shrink-0 gap-3 h-16">
        <div class="flex items-center justify-center bg-[#EFE9FB] rounded-[9px] shrink-0 h-[34px] w-[34px]">
          <div class="text-[#7257B7] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold">
            SA
          </div>
        </div>
        <div class="flex flex-col flex-1 gap-[3px] min-w-0">
          <div class="text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-[650] truncate">
            Sales Associate &mdash; Q3 Hiring
          </div>
          <div class="text-[#7890A0] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] truncate">
            9 dari 20 kandidat &middot; berakhir 17.30
          </div>
        </div>
        <div class="flex items-center bg-[#E7F6EE] rounded-xl shrink-0 gap-1.5 h-6 px-[9px]">
          <div class="bg-[#198754] rounded-[3px] shrink-0 h-1.5 w-1.5"></div>
          <div class="text-[#19734A] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">
            Aktif
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mulai dari sini -->
  <div class="flex flex-col bg-[#102A43] rounded-[14px] flex-1 overflow-hidden">
    <div class="flex flex-col gap-1.25 pt-5 pb-3.5 px-[22px]">
      <div class="text-white font-['Inter',system-ui,sans-serif] text-[17px]/[23px] font-bold tracking-[-0.015em]">
        Mulai dari sini
      </div>
      <div class="text-[#AFC2D0] font-['Inter',system-ui,sans-serif] text-[13px]/[18px]">
        Kelola kebutuhan asesmen berikutnya.
      </div>
    </div>
    
    <!-- Action Item 1 -->
    <a href="{{ url('/hr/question-bank/create') }}" class="flex items-center border-t border-[#DDE6ED29] shrink-0 gap-3 h-[58px] px-[22px] cursor-pointer hover:bg-[#15344F] transition-colors no-underline">
      <div class="flex items-center justify-center bg-[#1D4C63] rounded-lg shrink-0 h-[30px] w-[30px]">
        <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <rect x="4" y="3" width="16" height="18" rx="2" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8 7h8" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M8 11h8" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
      <div class="text-white flex-1 font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold">
        Tambah soal baru
      </div>
      <div class="text-[#75D5D0] font-['Inter',system-ui,sans-serif] text-[16px]/[18px] font-medium">
        &rarr;
      </div>
    </a>
    
    <!-- Action Item 2 -->
    <a href="{{ url('/hr/test-packages/create') }}" class="flex items-center border-t border-[#DDE6ED29] shrink-0 gap-3 h-[58px] px-[22px] cursor-pointer hover:bg-[#15344F] transition-colors no-underline">
      <div class="flex items-center justify-center bg-[#1D4C63] rounded-lg shrink-0 h-[30px] w-[30px]">
        <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="m21 16-9 5-9-5" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="m21 12-9 5-9-5" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="m21 8-9 5-9-5 9-5 9 5Z" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
      <div class="text-white flex-1 font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold">
        Susun paket tes
      </div>
      <div class="text-[#75D5D0] font-['Inter',system-ui,sans-serif] text-[16px]/[18px] font-medium">
        &rarr;
      </div>
    </a>

    <!-- Action Item 3 -->
    <a href="{{ url('/hr/candidates/import') }}" class="flex items-center border-t border-[#DDE6ED29] shrink-0 gap-3 h-[58px] px-[22px] cursor-pointer hover:bg-[#15344F] transition-colors no-underline">
      <div class="flex items-center justify-center bg-[#1D4C63] rounded-lg shrink-0 h-[30px] w-[30px]">
        <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <circle cx="9" cy="7" r="4" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M19 8v6" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M22 11h-6" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>
      <div class="text-white flex-1 font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-semibold">
        Impor kandidat
      </div>
      <div class="text-[#75D5D0] font-['Inter',system-ui,sans-serif] text-[16px]/[18px] font-medium">
        &rarr;
      </div>
    </a>
  </div>
</div>
@endsection

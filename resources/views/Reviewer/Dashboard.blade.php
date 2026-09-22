@extends('layouts.reviewer')

@section('title', 'Ringkasan')
@section('page_title', 'Ringkasan')

@section('content')

{{-- Top Header Section --}}
<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">WORKSPACE REVIEWER</div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold">Selamat pagi, Fajar</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">Selesaikan penilaian essay dan bantu HR menerbitkan skor akhir kandidat.</div>
  </div>
  <a href="{{ url('/reviewer/review-essay') }}" class="flex items-center gap-2 h-[42px] px-[18px] bg-[#17879A] rounded-[10px] cursor-pointer hover:bg-[#147D92] transition-colors no-underline shrink-0">
    <span class="text-white font-['Inter',system-ui,sans-serif] text-[17px]/[22px] font-bold">&rarr;</span>
    <span class="text-white font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold">Buka antrean review</span>
  </a>
</div>

{{-- Stat Cards Row --}}
<div class="flex gap-4">
  {{-- Card 1: Menunggu review --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#FFF3E0] rounded-[11px]">
      <span class="text-[#D97706] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">!</span>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Menunggu review</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">19</div>
    </div>
  </div>

  {{-- Card 2: Dinilai minggu ini --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#E6F4F7] rounded-[11px]">
      <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">&check;</span>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Dinilai minggu ini</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">24</div>
    </div>
  </div>

  {{-- Card 3: Rata-rata waktu review --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#F0ECF9] rounded-[11px]">
      <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">&#9719;</span>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Rata-rata waktu review</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">8 mnt</div>
    </div>
  </div>

  {{-- Card 4: Selesai bulan ini --}}
  <div class="flex flex-1 items-center gap-3.5 bg-white border border-[#DCE6EC] rounded-[14px] p-[18px] min-h-[76px]">
    <div class="flex items-center justify-center shrink-0 size-[38px] bg-[#E7F5EC] rounded-[11px]">
      <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-bold">&#9733;</span>
    </div>
    <div class="flex flex-col gap-1">
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">Selesai bulan ini</div>
      <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[24px]/[30px] font-extrabold">86</div>
    </div>
  </div>
</div>

{{-- Two Columns Content --}}
<div class="flex gap-4">

  {{-- Left Card: Antrean Prioritas --}}
  <div class="flex flex-[1.25] flex-col gap-4 bg-white border border-[#DCE6EC] rounded-[14px] p-5.5">
    <div class="flex items-start justify-between">
      <div class="flex flex-col gap-1">
        <div class="font-['Inter',system-ui,sans-serif] font-extrabold text-[#102A43] text-[15px]/[18px]">Antrean prioritas</div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#7A8A9A] text-[12px]/[16px]">Essay yang perlu ditinjau berikutnya</div>
      </div>
      <a href="{{ url('/reviewer/review-essay') }}" class="font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[12px]/[16px] hover:underline no-underline">
        Lihat semua &rarr;
      </a>
    </div>

    {{-- Item 1: Sari Wulandari --}}
    <div class="flex items-center py-3 border-t border-[#E6EDF2]">
      <div class="flex items-center justify-center shrink-0 size border border-transparent rounded-[12px] bg-[#F0ECF9] size-[42px]">
        <span class="text-[#6B4FA1] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">SW</span>
      </div>
      <div class="flex flex-col flex-1 min-w-0 gap-1 pl-3">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Sari Wulandari</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">Leadership Trainee &middot; Essay #04</div>
      </div>
      <div class="flex flex-col items-end gap-1 shrink-0">
        <span class="inline-block px-2.25 py-1 rounded-full bg-[#FFF3E0]">
          <span class="text-[#B16A00] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Prioritas</span>
        </span>
        <span class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">2 jam lalu</span>
      </div>
    </div>

    {{-- Item 2: Rizky Adinata --}}
    <div class="flex items-center py-3 border-t border-[#E6EDF2]">
      <div class="flex items-center justify-center shrink-0 rounded-[12px] bg-[#E6F4F7] size-[42px]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">RA</span>
      </div>
      <div class="flex flex-col flex-1 min-w-0 gap-1 pl-3">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Rizky Adinata</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">Sales Associate &middot; Essay #07</div>
      </div>
      <div class="flex flex-col items-end gap-1 shrink-0">
        <span class="inline-block px-2.25 py-1 rounded-full bg-[#E6F4F7]">
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Baru</span>
        </span>
        <span class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">4 jam lalu</span>
      </div>
    </div>

    {{-- Item 3: Dewi Larasati --}}
    <div class="flex items-center py-3 border-t border-[#E6EDF2]">
      <div class="flex items-center justify-center shrink-0 rounded-[12px] bg-[#E7F5EC] size-[42px]">
        <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-extrabold">DW</span>
      </div>
      <div class="flex flex-col flex-1 min-w-0 gap-1 pl-3">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-bold truncate">Dewi Larasati</div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] truncate">Graduate Development &middot; Essay #02</div>
      </div>
      <div class="flex flex-col items-end gap-1 shrink-0">
        <span class="inline-block px-2.25 py-1 rounded-full bg-[#E7F5EC]">
          <span class="text-[#198754] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold">Terakhir</span>
        </span>
        <span class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]">Kemarin</span>
      </div>
    </div>

  </div>

  {{-- Right Card: Aktivitas Saya (Dark Theme) --}}
  <div class="flex flex-[0.8] flex-col gap-4 bg-[#102A43] border border-[#DCE6EC] rounded-[14px] p-5.5">
    <div class="flex flex-col gap-1">
      <div class="font-['Inter',system-ui,sans-serif] font-extrabold text-white text-[15px]/[18px]">Aktivitas saya</div>
      <div class="font-['Inter',system-ui,sans-serif] text-[#B7C8D5] text-[12px]/[16px]">Ringkasan pekerjaan reviewer</div>
    </div>

    <div class="flex flex-col gap-3.5 pt-1">
      <div class="flex items-center justify-between">
        <span class="font-['Inter',system-ui,sans-serif] text-[#B7C8D5] text-[12px]/[16px]">Target minggu ini</span>
        <span class="font-['Inter',system-ui,sans-serif] text-white text-[15px]/[18px] font-semibold">30 essay</span>
      </div>
      <div class="h-2 rounded-full bg-[#24445A] shrink-0">
        <div class="h-2 rounded-full bg-[#2A9D8F]" style="width: 80%;"></div>
      </div>
      <div class="flex justify-between">
        <span class="font-['Inter',system-ui,sans-serif] text-[#B7C8D5] text-[11px]/[14px]">24 selesai</span>
        <span class="font-['Inter',system-ui,sans-serif] text-[#B7C8D5] text-[11px]/[14px]">80%</span>
      </div>
    </div>

    <div class="h-px bg-[#2A4B60] shrink-0"></div>

    <div class="flex flex-col gap-2.5">
      <div class="flex justify-between items-center">
        <span class="font-['Inter',system-ui,sans-serif] text-[#B7C8D5] text-[12px]/[16px]">Skor rata-rata saya</span>
        <span class="font-['Inter',system-ui,sans-serif] text-white text-[12px]/[16px] font-semibold">82,6</span>
      </div>
      <div class="flex justify-between items-center">
        <span class="font-['Inter',system-ui,sans-serif] text-[#B7C8D5] text-[12px]/[16px]">Penilaian hari ini</span>
        <span class="font-['Inter',system-ui,sans-serif] text-white text-[12px]/[16px] font-semibold">6 essay</span>
      </div>
    </div>

  </div>

</div>

@endsection

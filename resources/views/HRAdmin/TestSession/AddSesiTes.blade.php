@extends('layouts.hradmin')

@section('title', 'Buat Sesi Tes')
@section('page_title', 'Buat sesi tes')

@section('content')

{{-- Flatpickr untuk date & time picker --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>

<style>
  .flatpickr-calendar {
    font-family: 'Inter', system-ui, sans-serif !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.1) !important;
    border: 1px solid #EDF2F5 !important;
  }
  .flatpickr-day.selected, .flatpickr-day.selected:hover {
    background: #147D92 !important;
    border-color: #147D92 !important;
  }
</style>

<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-bold tracking-[0.06em]">
      PELAKSANAAN ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[32px]/[38px] font-[750] tracking-[-0.035em]">
      Buat sesi tes
    </div>
    <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
      Jadwalkan sesi baru dan hubungkan dengan paket tes yang tersedia.
    </div>
  </div>
  <a href="{{ url('/hr/test-sessions') }}" class="h-10 flex items-center px-[13px] rounded-[9px] gap-2 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
      <path d="m15 18-6-6 6-6" fill="none" stroke="#486174" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
      Kembali
    </div>
  </a>
</div>

<div class="flex flex-col gap-5 mt-2">
  <form class="flex flex-col gap-5">

    {{-- Card 1: Informasi Sesi --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
          Informasi sesi
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
          Isi detail dasar sesi tes yang akan dijadwalkan.
        </div>
      </div>

      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Nama Sesi --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Nama sesi <span class="text-[#E53E3E]">*</span>
          </label>
          <input type="text" name="nama_sesi" placeholder="Contoh: Leadership Trainee — Batch 08"
            class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Gunakan nama yang menggambarkan program atau batch rekrutmen.
          </div>
        </div>

        {{-- Paket Tes & Status (2 kolom) --}}
        <div class="grid grid-cols-2 gap-5">

          {{-- Paket Tes --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Paket tes <span class="text-[#E53E3E]">*</span>
            </label>
            <div class="relative">
              <select name="paket_tes"
                class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="" disabled selected hidden>Pilih paket tes</option>
                <option value="1">Assessment Dasar</option>
                <option value="2">Sales &amp; Service</option>
                <option value="3">Kompetensi &amp; Logika</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Pilih paket tes yang akan digunakan pada sesi ini.
            </div>
          </div>

          {{-- Status --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Status <span class="text-[#E53E3E]">*</span>
            </label>
            <div class="relative">
              <select name="status"
                class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="terjadwal" selected>Terjadwal</option>
                <option value="aktif">Aktif</option>
                <option value="selesai">Selesai</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Status dapat diperbarui kapanpun dari daftar sesi.
            </div>
          </div>

        </div>

      </div>
    </div>

    {{-- Card 2: Jadwal & Waktu --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
          Jadwal pelaksanaan
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
          Tentukan tanggal dan rentang waktu pelaksanaan sesi.
        </div>
      </div>

      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Tanggal Pelaksanaan --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Tanggal pelaksanaan <span class="text-[#E53E3E]">*</span>
          </label>
          <div class="relative">
            <div class="flex items-center border border-[#DDE6ED] rounded-[9px] gap-2.5 h-[42px] px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92] cursor-pointer">
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="shrink-0 pointer-events-none">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M16 2v4M8 2v4M3 10h18" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <input type="text" name="tanggal" placeholder="Pilih tanggal pelaksanaan..."
                x-init="flatpickr($el, { dateFormat: 'd M Y', locale: (flatpickr.l10ns && flatpickr.l10ns.id) ? flatpickr.l10ns.id : 'default' })"
                class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] w-full cursor-pointer placeholder:text-[#A2B0BA]">
            </div>
          </div>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Pilih satu tanggal pelaksanaan sesi tes.
          </div>
        </div>

        {{-- Jam Mulai & Jam Selesai (2 kolom) --}}
        <div class="grid grid-cols-2 gap-5">

          {{-- Jam Mulai --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Jam mulai <span class="text-[#E53E3E]">*</span>
            </label>
            <div class="relative">
              <div class="flex items-center border border-[#DDE6ED] rounded-[9px] gap-2.5 h-[42px] px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92]">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" class="shrink-0 pointer-events-none">
                  <circle cx="12" cy="12" r="10" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <polyline points="12 6 12 12 16 14" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="time" name="jam_mulai"
                  class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] w-full cursor-pointer">
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Waktu Indonesia Barat (WIB).
            </div>
          </div>

          {{-- Jam Selesai --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Jam selesai <span class="text-[#E53E3E]">*</span>
            </label>
            <div class="relative">
              <div class="flex items-center border border-[#DDE6ED] rounded-[9px] gap-2.5 h-[42px] px-3 bg-white hover:bg-gray-50 transition-colors focus-within:border-[#147D92]">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" class="shrink-0 pointer-events-none">
                  <circle cx="12" cy="12" r="10" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  <polyline points="12 6 12 12 16 14" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <input type="time" name="jam_selesai"
                  class="bg-transparent border-none outline-none text-[#314E60] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] w-full cursor-pointer">
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Harus lebih dari jam mulai.
            </div>
          </div>

        </div>

        {{-- Batas Peserta --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Batas peserta <span class="text-[#A2B0BA] font-normal">(opsional)</span>
          </label>
          <input type="number" name="batas_peserta" placeholder="Contoh: 50" min="1"
            class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full max-w-sm">
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Kosongkan jika tidak ada batas jumlah kandidat.
          </div>
        </div>

      </div>
    </div>

    {{-- Card 3: Catatan --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
          Catatan
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
          Informasi tambahan untuk tim HR terkait sesi ini.
        </div>
      </div>

      <div class="flex flex-col py-[22px] px-6 gap-[18px]">
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Catatan internal <span class="text-[#A2B0BA] font-normal">(opsional)</span>
          </label>
          <textarea name="catatan" rows="4" placeholder="Contoh: Sesi ini diperuntukkan kandidat batch 08 program leadership trainee, mohon pastikan ruang ujian sudah disiapkan..."
            class="px-3 py-2.5 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Tidak ditampilkan ke kandidat. Hanya terlihat oleh tim HR.
          </div>
        </div>
      </div>
    </div>

    {{-- Form Footer --}}
    <div class="flex items-center justify-end gap-3">
      <a href="{{ url('/hr/test-sessions') }}"
        class="flex items-center h-10 px-[14px] bg-white border border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
        <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
          Batal
        </div>
      </a>
      <button type="submit"
        class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
        <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]">
          Buat sesi tes
        </div>
      </button>
    </div>

  </form>
</div>

@endsection

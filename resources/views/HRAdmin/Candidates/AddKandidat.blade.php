@extends('layouts.hradmin')

@section('title', 'Tambah Kandidat')
@section('page_title', 'Tambah kandidat')

@section('content')

<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">DATA PESERTA</div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold">Tambah kandidat</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">Daftarkan peserta baru dan kirimkan undangan tes secara langsung.</div>
  </div>
  <a href="{{ url('/hr/candidates') }}" class="h-10 flex items-center px-[13px] rounded-[9px] gap-2 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
      <path d="m15 18-6-6 6-6" fill="none" stroke="#486174" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">Kembali</div>
  </a>
</div>

<div class="flex flex-col gap-5 mt-2">
  <form class="flex flex-col gap-5">

    {{-- Card 1: Informasi Kandidat --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">Informasi kandidat</div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">Lengkapi data identitas kandidat yang akan didaftarkan.</div>
      </div>
      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Nama & Email (2 kolom) --}}
        <div class="grid grid-cols-2 gap-5">
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Nama lengkap <span class="text-[#E53E3E]">*</span>
            </label>
            <input type="text" name="nama" placeholder="Contoh: Andi Pratama"
              class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">Nama lengkap sesuai identitas resmi.</div>
          </div>
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Alamat email <span class="text-[#E53E3E]">*</span>
            </label>
            <input type="email" name="email" placeholder="nama@email.com"
              class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">Undangan tes akan dikirim ke email ini.</div>
          </div>
        </div>

        {{-- Telepon & Posisi Dilamar (2 kolom) --}}
        <div class="grid grid-cols-2 gap-5">
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Nomor telepon <span class="text-[#A2B0BA] font-normal">(opsional)</span>
            </label>
            <input type="tel" name="telepon" placeholder="Contoh: 08123456789"
              class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
          </div>
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Posisi dilamar <span class="text-[#A2B0BA] font-normal">(opsional)</span>
            </label>
            <input type="text" name="posisi" placeholder="Contoh: Leadership Trainee"
              class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
          </div>
        </div>

        {{-- Catatan --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Catatan <span class="text-[#A2B0BA] font-normal">(opsional)</span>
          </label>
          <textarea name="catatan" rows="3" placeholder="Catatan internal tentang kandidat ini..."
            class="px-3 py-2.5 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">Tidak ditampilkan kepada kandidat.</div>
        </div>

      </div>
    </div>

    {{-- Card 2: Sesi Tes --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">Sesi tes</div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">Pilih sesi tes yang akan diikuti oleh kandidat ini.</div>
      </div>
      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Sesi Tes --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Sesi tes <span class="text-[#E53E3E]">*</span>
          </label>
          <div class="relative">
            <select name="sesi_tes"
              class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
              <option value="" disabled selected hidden>Pilih sesi tes</option>
              <option value="1">Leadership Trainee — Batch 08</option>
              <option value="2">Sales Associate — Q3 Hiring</option>
              <option value="3">Graduate Development Program</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
              <svg width="16" height="16" viewBox="0 0 24 24" class="shrink-0">
                <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">Kandidat akan terdaftar di sesi yang dipilih.</div>
        </div>

      </div>
    </div>

    {{-- Card 3: Kirim Undangan --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">Undangan tes</div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">Tentukan apakah undangan tes dikirim segera setelah kandidat ditambahkan.</div>
      </div>
      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Checkbox kirim undangan --}}
        <label x-data="{ checked: true }" class="flex items-start gap-[11px] p-[14px] bg-[#FAFCFD] border border-solid border-[#DDE6ED] rounded-[11px] cursor-pointer select-none" @click.prevent="checked = !checked">
          <input type="checkbox" class="hidden" x-bind:checked="checked" name="kirim_undangan" />
          <div :class="checked ? 'bg-[#147D92] border-[#147D92]' : 'bg-white border-[#DDE6ED]'" class="flex items-center justify-center h-[18px] w-[18px] shrink-0 border border-solid rounded-[5px] mt-0.5 transition-colors">
            <svg x-show="checked" style="display: none;" width="13" height="13" viewBox="0 0 24 24" class="shrink-0">
              <path d="m5 12 4 4L19 6" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div class="flex flex-col gap-1">
            <div class="font-['Inter',system-ui,sans-serif] font-[650] text-[#314E60] text-[13px]/[18px]">Kirim undangan tes sekarang</div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[12px]/[17px]">Kandidat akan menerima email berisi token akses dan instruksi untuk memulai tes.</div>
          </div>
        </label>

      </div>
    </div>

    {{-- Form Footer --}}
    <div class="flex items-center justify-end gap-3">
      <a href="{{ url('/hr/candidates') }}"
        class="flex items-center h-10 px-[14px] bg-white border border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
        <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">Batal</div>
      </a>
      <button type="submit"
        class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
        <svg width="16" height="16" viewBox="0 0 24 24" class="shrink-0">
          <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]">Tambah kandidat</div>
      </button>
    </div>

  </form>
</div>

@endsection

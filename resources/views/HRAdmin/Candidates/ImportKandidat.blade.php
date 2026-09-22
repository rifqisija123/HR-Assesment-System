@extends('layouts.hradmin')

@section('title', 'Impor Kandidat')
@section('page_title', 'Impor kandidat')

@section('content')

{{-- Page Header --}}
<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">DATA PESERTA</div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[30px]/[36px] font-extrabold">Impor kandidat</div>
    <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[14px]/[18px]">Unggah berkas spreadsheet (Excel/CSV) untuk menambah banyak kandidat sekaligus.</div>
  </div>
  <a href="{{ url('/hr/candidates') }}" class="h-10 flex items-center px-[13px] rounded-[9px] gap-2 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
      <path d="m15 18-6-6 6-6" fill="none" stroke="#486174" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">Kembali</div>
  </a>
</div>

<div class="flex flex-col gap-5 mt-2">
  <form class="flex flex-col gap-5" x-data="{ fileName: '', fileSize: '', isDragging: false }">

    {{-- Card 1: Templat Berkas Spreadsheet --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">Templat & petunjuk impor</div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">Gunakan templat resmi untuk memastikan data kandidat terstruktur dan terbaca dengan benar.</div>
      </div>
      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Download Box --}}
        <div class="flex items-center justify-between p-4 bg-[#F8FAFC] border border-[#E2E8F0] rounded-[12px] gap-4">
          <div class="flex items-center gap-3.5 min-w-0">
            <div class="flex items-center justify-center shrink-0 size-11 bg-[#E6F4F7] rounded-[10px]">
              <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <polyline points="14 2 14 8 20 8" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M8 13h8M8 17h8" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <div class="flex flex-col gap-0.5 min-w-0">
              <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[14px]/[18px]">Templat Excel (.xlsx)</div>
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[12px]/[16px]">Sudah dilengkapi dengan contoh format kolom data kandidat.</div>
            </div>
          </div>
          <button type="button" class="flex items-center gap-2 h-[38px] px-4 bg-[#147D92] rounded-[9px] cursor-pointer hover:bg-[#116a7c] transition-colors border-none shrink-0">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <polyline points="7 10 12 15 17 10" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <line x1="12" y1="15" x2="12" y2="3" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="font-['Inter',system-ui,sans-serif] font-semibold text-white text-[13px]/[16px]">Unduh templat</span>
          </button>
        </div>

        {{-- Format Kolom Guidelines --}}
        <div class="flex flex-col gap-2.5">
          <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">Format susunan kolom dalam berkas:</div>
          <div class="flex flex-wrap items-center gap-2">
            <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-[#E6F4F7] border border-[#BDE3EB] text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px] font-bold">
              Nama Lengkap <span class="text-[#E53E3E] ml-0.5">*</span>
            </span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-[#E6F4F7] border border-[#BDE3EB] text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px] font-bold">
              Email <span class="text-[#E53E3E] ml-0.5">*</span>
            </span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-[#F8FAFC] border border-[#DDE6ED] text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px] font-medium">
              Nomor Telepon
            </span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-[#F8FAFC] border border-[#DDE6ED] text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px] font-medium">
              Posisi Dilamar
            </span>
            <span class="inline-flex items-center px-3 py-1.5 rounded-md bg-[#F8FAFC] border border-[#DDE6ED] text-[#62798A] font-['Inter',system-ui,sans-serif] text-[12px] font-medium">
              Catatan
            </span>
          </div>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[17px]">
            <span class="text-[#E53E3E] font-medium">*</span> Kolom Nama Lengkap dan Email wajib diisi pada setiap baris data. Email kandidat harus unik.
          </div>
        </div>

      </div>
    </div>

    {{-- Card 2: Unggah Berkas Kandidat --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">Unggah berkas kandidat</div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">Pilih atau seret berkas spreadsheet yang berisi daftar kandidat.</div>
      </div>
      <div class="flex flex-col py-[22px] px-6 gap-[18px]">

        {{-- Drop Area --}}
        <div class="relative flex flex-col items-center justify-center p-8 border-2 border-dashed rounded-[14px] transition-colors cursor-pointer"
          :class="isDragging ? 'border-[#147D92] bg-[#F4FBFB]' : 'border-[#CBD5E1] bg-[#FAFCFD] hover:bg-[#F8FAFC] hover:border-[#94A3B8]'"
          @dragover.prevent="isDragging = true"
          @dragleave.prevent="isDragging = false"
          @drop.prevent="
            isDragging = false;
            if ($event.dataTransfer.files.length > 0) {
              const file = $event.dataTransfer.files[0];
              fileName = file.name;
              fileSize = (file.size / 1024).toFixed(1) + ' KB';
            }
          "
          @click="$refs.fileInput.click()">

          <input type="file" x-ref="fileInput" class="hidden" accept=".xlsx, .xls, .csv"
            @change="
              if ($event.target.files.length > 0) {
                const file = $event.target.files[0];
                fileName = file.name;
                fileSize = (file.size / 1024).toFixed(1) + ' KB';
              }
            " />

          <div class="flex items-center justify-center size-12 bg-[#E6F4F7] rounded-full mb-3">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <polyline points="17 8 12 3 7 8" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              <line x1="12" y1="3" x2="12" y2="15" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>

          <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[14px]/[20px] text-center">
            Seret & lepas berkas ke sini, atau <span class="text-[#147D92] underline">pilih dari komputer</span>
          </div>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px] text-center mt-1">
            Format didukung: .xlsx, .xls, .csv (Maksimal 10 MB)
          </div>
        </div>

        {{-- Preview Box when file selected --}}
        <template x-if="fileName">
          <div class="flex items-center justify-between p-3.5 bg-[#E6F5F2] border border-[#A7E2D6] rounded-[11px]">
            <div class="flex items-center gap-3 min-w-0">
              <div class="flex items-center justify-center shrink-0 size-9 bg-[#147D92] rounded-[8px]">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                  <path d="M20 6L9 17l-5-5" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
              <div class="flex flex-col min-w-0">
                <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[13px]/[17px] truncate" x-text="fileName"></div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#147D92] text-[11px]/[15px] font-semibold">
                  <span x-text="fileSize"></span> &middot; Berkas siap diimpor
                </div>
              </div>
            </div>
            <button type="button" @click.stop="fileName = ''; fileSize = ''; $refs.fileInput.value = ''"
              class="p-1 rounded-md text-[#62798A] hover:text-[#E53E3E] hover:bg-white/60 transition-colors border-none bg-transparent cursor-pointer">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                <line x1="18" y1="6" x2="6" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <line x1="6" y1="6" x2="18" y2="18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </button>
          </div>
        </template>

      </div>
    </div>

    {{-- Card 3: Target Sesi Tes & Undangan --}}
    <div class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">Sesi tes & pengiriman undangan</div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">Tentukan sesi tes yang akan didaftarkan untuk seluruh kandidat yang diimpor.</div>
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
              <option value="" disabled selected hidden>Pilih sesi tes target</option>
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
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">Seluruh kandidat dalam berkas akan dimasukkan ke dalam sesi ini.</div>
        </div>

        {{-- Checkbox Kirim Undangan --}}
        <label x-data="{ checked: true }" class="flex items-start gap-[11px] p-[14px] bg-[#FAFCFD] border border-solid border-[#DDE6ED] rounded-[11px] cursor-pointer select-none" @click.prevent="checked = !checked">
          <input type="checkbox" class="hidden" x-bind:checked="checked" name="kirim_undangan" />
          <div :class="checked ? 'bg-[#147D92] border-[#147D92]' : 'bg-white border-[#DDE6ED]'" class="flex items-center justify-center h-[18px] w-[18px] shrink-0 border border-solid rounded-[5px] mt-0.5 transition-colors">
            <svg x-show="checked" style="display: none;" width="13" height="13" viewBox="0 0 24 24" class="shrink-0">
              <path d="m5 12 4 4L19 6" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <div class="flex flex-col gap-1">
            <div class="font-['Inter',system-ui,sans-serif] font-[650] text-[#314E60] text-[13px]/[18px]">Kirim undangan tes secara otomatis</div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[12px]/[17px]">Email berisi token akses akan dikirimkan ke setiap kandidat setelah impor berhasil diselesaikan.</div>
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
        class="flex items-center h-10 px-4 gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" class="shrink-0">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <polyline points="17 8 12 3 7 8" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <line x1="12" y1="3" x2="12" y2="15" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]">Mulai impor kandidat</div>
      </button>
    </div>

  </form>
</div>

@endsection

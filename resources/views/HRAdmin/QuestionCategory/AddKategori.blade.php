@extends('layouts.hradmin')

@section('title', 'Tambah Kategori Soal')
@section('page_title', 'Tambah kategori soal')

@section('content')

<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-bold tracking-[0.06em]">
      MATERI ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[32px]/[38px] font-[750] tracking-[-0.035em]">
      Tambah kategori soal
    </div>
    <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
      Buat kategori baru untuk mengelompokkan soal asesmen.
    </div>
  </div>
  <a href="{{ url('/hr/question-categories') }}" class="h-10 flex items-center px-[13px] rounded-[9px] gap-2 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
      <path d="m15 18-6-6 6-6" fill="none" stroke="#486174" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
      Kembali
    </div>
  </a>
</div>

<div class="flex flex-col mt-2">
  <form class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">

    {{-- Form Header --}}
    <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
      <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
        Informasi kategori
      </div>
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
        Lengkapi data di bawah untuk membuat kategori soal baru.
      </div>
    </div>

    {{-- Form Body --}}
    <div class="flex flex-col py-[22px] px-6 gap-[18px]">

      {{-- Nama Kategori --}}
      <div class="flex flex-col gap-[7px]">
        <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Nama kategori <span class="text-[#E53E3E]">*</span>
        </label>
        <input type="text" name="nama_kategori" placeholder="Contoh: Logika & Penalaran"
          class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
        <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
          Gunakan nama yang jelas dan mudah dipahami oleh tim HR.
        </div>
      </div>

      {{-- Deskripsi --}}
      <div class="flex flex-col gap-[7px]">
        <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Deskripsi <span class="text-[#A2B0BA] font-normal">(opsional)</span>
        </label>
        <textarea name="deskripsi" rows="4" placeholder="Tuliskan penjelasan singkat mengenai jenis soal pada kategori ini..."
          class="px-3 py-2.5 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
        <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
          Jelaskan tujuan dan cakupan topik kategori ini.
        </div>
      </div>

      {{-- Jumlah Soal, Tipe & Status (3 kolom) --}}
      <div class="grid grid-cols-3 gap-5">

        {{-- Jumlah Soal --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Jumlah soal <span class="text-[#E53E3E]">*</span>
          </label>
          <input type="number" name="jumlah_soal" placeholder="0" min="0"
            class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Tentukan soal untuk ditambahkan pada bank soal.
          </div>
        </div>

        {{-- Tipe Soal --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Tipe soal <span class="text-[#E53E3E]">*</span>
          </label>
          <div class="relative">
            <select name="tipe"
              class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
              <option value="" disabled selected hidden>Pilih tipe soal</option>
              <option value="pilihan_ganda">Pilihan Ganda</option>
              <option value="essay">Essay</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
              <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Pilihan ganda untuk soal objektif, essay untuk soal uraian.
          </div>
        </div>

        {{-- Status --}}
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Status kategori <span class="text-[#E53E3E]">*</span>
          </label>
          <div class="relative">
            <select name="status"
              class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
              <option value="aktif" selected>Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
              <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Status dapat diubah sewaktu-waktu dari daftar kategori.
          </div>
        </div>

      </div>

    </div>

    {{-- Form Footer --}}
    <div class="flex items-center justify-end h-[72px] shrink-0 gap-[10px] px-6 border-t border-[#EDF2F5]">
      <a href="{{ url('/hr/question-categories') }}"
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
          Simpan kategori
        </div>
      </button>
    </div>

  </form>
</div>

@endsection

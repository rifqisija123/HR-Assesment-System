@extends('layouts.hradmin')

@section('title', 'Tambah Soal')
@section('page_title', 'Tambah soal')

@section('content')

<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-bold tracking-[0.06em]">
      MATERI ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[32px]/[38px] font-[750] tracking-[-0.035em]">
      Tambah soal
    </div>
    <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
      Buat soal baru untuk ditambahkan ke bank soal asesmen.
    </div>
  </div>
  <a href="{{ url('/hr/question-bank') }}" class="h-10 flex items-center px-[13px] rounded-[9px] gap-2 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
      <path d="m15 18-6-6 6-6" fill="none" stroke="#486174" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
      Kembali
    </div>
  </a>
</div>

{{-- kategoriTipe: mapping value kategori → tipe soal --}}
<div x-data="{
  kategori: '',
  kategoriTipe: {
    logika: 'pilihan_ganda',
    manajerial: 'pilihan_ganda',
    kompetensi: 'essay',
    bahasa: 'essay'
  },
  get tipe() {
    return this.kategori ? (this.kategoriTipe[this.kategori] || '') : '';
  },
  get isPilihanGanda() { return this.tipe === 'pilihan_ganda'; },
  get isEssay() { return this.tipe === 'essay'; }
}" class="flex flex-col mt-2">
  <form class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">

    {{-- Form Header --}}
    <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
      <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
        Informasi soal
      </div>
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
        Pilih kategori terlebih dahulu untuk melanjutkan pengisian soal.
      </div>
    </div>

    {{-- Form Body --}}
    <div class="flex flex-col py-[22px] px-6 gap-[18px]">

      {{-- Step 1: Pilih Kategori --}}
      <div class="flex flex-col gap-[7px]">
        <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Kategori <span class="text-[#E53E3E]">*</span>
        </label>
        <div class="relative">
          <select name="kategori" x-model="kategori"
            class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
            <option value="" disabled selected hidden>Pilih kategori soal</option>
            <option value="logika">Logika &amp; Penalaran — Pilihan Ganda</option>
            <option value="manajerial">Kepemimpinan &amp; Manajerial — Pilihan Ganda</option>
            <option value="kompetensi">Kompetensi Bidang — Essay</option>
            <option value="bahasa">Kemampuan Bahasa &amp; Komunikasi — Essay</option>
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
            <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
              <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
          Tipe soal (Pilihan Ganda / Essay) ditentukan otomatis berdasarkan kategori.
        </div>

        {{-- Tipe badge muncul setelah kategori dipilih --}}
        <div x-show="kategori" x-transition.opacity style="display:none;" class="flex items-center gap-2 mt-1">
          <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Tipe soal:</span>
          <span x-show="isPilihanGanda" style="display:none;"
            class="inline-flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-6 px-3">
            <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Pilihan Ganda</span>
          </span>
          <span x-show="isEssay" style="display:none;"
            class="inline-flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-6 px-3">
            <span class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold">Essay</span>
          </span>
        </div>
      </div>

      {{-- Konten form muncul setelah kategori dipilih --}}
      <template x-if="kategori">
        <div class="flex flex-col gap-[18px]">

          {{-- Pertanyaan (kedua tipe) --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Pertanyaan <span class="text-[#E53E3E]">*</span>
            </label>
            <textarea name="pertanyaan" rows="4" placeholder="Tulis pertanyaan soal di sini..."
              class="px-3 py-2.5 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Tuliskan pertanyaan secara jelas dan tidak ambigu.
            </div>
          </div>

          {{-- Pilihan Jawaban — hanya untuk Pilihan Ganda --}}
          <template x-if="isPilihanGanda">
            <div class="flex flex-col gap-[7px]">
              <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                Pilihan jawaban <span class="text-[#E53E3E]">*</span>
              </label>
              <div class="flex flex-col gap-3">

                {{-- Opsi A --}}
                <div class="flex items-center gap-3">
                  <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                    <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">A</span>
                  </div>
                  <input type="text" name="opsi_a" placeholder="Tulis opsi jawaban A..."
                    class="flex-1 h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                  <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                    <input type="radio" name="jawaban_benar" value="a" class="accent-[#147D92] cursor-pointer w-4 h-4">
                    <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                  </label>
                </div>

                {{-- Opsi B --}}
                <div class="flex items-center gap-3">
                  <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                    <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">B</span>
                  </div>
                  <input type="text" name="opsi_b" placeholder="Tulis opsi jawaban B..."
                    class="flex-1 h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                  <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                    <input type="radio" name="jawaban_benar" value="b" class="accent-[#147D92] cursor-pointer w-4 h-4">
                    <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                  </label>
                </div>

                {{-- Opsi C --}}
                <div class="flex items-center gap-3">
                  <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                    <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">C</span>
                  </div>
                  <input type="text" name="opsi_c" placeholder="Tulis opsi jawaban C..."
                    class="flex-1 h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                  <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                    <input type="radio" name="jawaban_benar" value="c" class="accent-[#147D92] cursor-pointer w-4 h-4">
                    <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                  </label>
                </div>

                {{-- Opsi D --}}
                <div class="flex items-center gap-3">
                  <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                    <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">D</span>
                  </div>
                  <input type="text" name="opsi_d" placeholder="Tulis opsi jawaban D..."
                    class="flex-1 h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                  <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                    <input type="radio" name="jawaban_benar" value="d" class="accent-[#147D92] cursor-pointer w-4 h-4">
                    <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                  </label>
                </div>

              </div>
              <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
                Pilih satu opsi sebagai jawaban yang benar.
              </div>
            </div>
          </template>

          {{-- Skor & Status — hanya untuk Pilihan Ganda --}}
          <template x-if="isPilihanGanda">
            <div class="grid grid-cols-2 gap-5">
              <div class="flex flex-col gap-[7px]">
                <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                  Skor <span class="text-[#E53E3E]">*</span>
                </label>
                <input type="number" name="skor" placeholder="Contoh: 10" min="1"
                  class="h-[42px] px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
                <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
                  Nilai poin untuk soal ini dalam paket tes.
                </div>
              </div>
              <div class="flex flex-col gap-[7px]">
                <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                  Status <span class="text-[#E53E3E]">*</span>
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
                  Soal nonaktif tidak akan muncul di paket tes.
                </div>
              </div>
            </div>
          </template>

          {{-- Status — hanya untuk Essay (tanpa skor) --}}
          <template x-if="isEssay">
            <div class="flex flex-col gap-[7px]">
              <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                Status <span class="text-[#E53E3E]">*</span>
              </label>
              <div class="relative w-full max-w-sm">
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
                Soal essay akan direview dan dinilai secara manual oleh Reviewer.
              </div>
            </div>
          </template>

          {{-- Keterangan (kedua tipe) --}}
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Keterangan <span class="text-[#A2B0BA] font-normal">(opsional)</span>
            </label>
            <textarea name="keterangan" rows="3" placeholder="Contoh: Rubrik penilaian tersedia, soal diperbarui dari versi sebelumnya..."
              class="px-3 py-2.5 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Catatan internal untuk tim HR, tidak ditampilkan ke kandidat.
            </div>
          </div>

        </div>
      </template>

    </div>

    {{-- Form Footer --}}
    <div class="flex items-center justify-end h-[72px] shrink-0 gap-[10px] px-6 border-t border-[#EDF2F5]">
      <a href="{{ url('/hr/question-bank') }}"
        class="flex items-center h-10 px-[14px] bg-white border border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
        <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
          Batal
        </div>
      </a>
      <button type="submit" :disabled="!kategori"
        class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
        <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]">
          Simpan soal
        </div>
      </button>
    </div>

  </form>
</div>

@endsection

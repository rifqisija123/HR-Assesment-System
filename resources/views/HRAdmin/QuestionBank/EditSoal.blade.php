@extends('layouts.hradmin')

@section('title', 'Edit Soal')
@section('page_title', 'Edit soal')

@section('content')

<div class="flex items-end justify-between gap-6">
  <div class="flex flex-col gap-2">
    <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-bold tracking-[0.06em]">
      MATERI ASESMEN
    </div>
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[32px]/[38px] font-[750] tracking-[-0.035em]">
      Edit soal
    </div>
    <div class="text-[#62798A] font-['Inter',system-ui,sans-serif] text-[15px]/[22px]">
      Perbarui informasi pertanyaan, pilihan jawaban, skor, dan status soal asesmen.
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

<div x-data="editSoalForm(@js($questionData))" class="flex flex-col mt-2">
  {{-- Alert Error Umum --}}
  <div x-show="generalError" x-transition.opacity style="display: none;" class="mb-4 flex items-start gap-3 px-4 py-3.5 rounded-[12px] bg-[#FEF2F2] border border-[#FBD5D5] text-[#C53030]">
    <svg width="18" height="18" viewBox="0 0 24 24" class="shrink-0 mt-0.5">
      <circle cx="12" cy="12" r="10" fill="none" stroke="#C53030" stroke-width="2"/>
      <path d="M12 8v4M12 16h.01" stroke="#C53030" stroke-width="2" stroke-linecap="round"/>
    </svg>
    <div class="font-['Inter',system-ui,sans-serif] text-[13px]/[18px] font-medium" x-text="generalError"></div>
  </div>

  <form @submit.prevent="submit" novalidate class="flex flex-col w-full overflow-hidden bg-white border border-[#DDE6ED] rounded-[14px]">

    {{-- Form Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
      <div class="flex flex-col gap-1">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
          Informasi soal
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
          Perbarui detail soal di bawah sesuai dengan tipe soal pada kategori.
        </div>
      </div>

      {{-- Badge Kategori & Tipe Soal --}}
      <div class="flex flex-wrap items-center gap-2.5">
        <div class="inline-flex items-center justify-center rounded-[6px] h-7 px-3" :class="isEssay ? 'bg-[#EFE9FB]' : 'bg-[#E7EEF9]'">
          <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold" :class="isEssay ? 'text-[#7257B7]' : 'text-[#3B5B93]'" x-text="form.category_name"></span>
        </div>
        <div x-show="isPilihanGanda" style="display: none;" class="inline-flex items-center justify-center bg-[#E2F4F3] rounded-[6px] h-7 px-3">
          <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold">Pilihan Ganda</span>
        </div>
        <div x-show="isEssay" style="display: none;" class="inline-flex items-center justify-center bg-[#FFF3DF] rounded-[6px] h-7 px-3">
          <span class="text-[#B45309] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold">Essay</span>
        </div>
      </div>
    </div>

    {{-- Form Body --}}
    <div class="flex flex-col py-[22px] px-6 gap-[20px]">

      {{-- Pertanyaan (kedua tipe) --}}
      <div class="flex flex-col gap-[7px]">
        <label for="pertanyaan" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Pertanyaan <span class="text-[#E53E3E]">*</span>
        </label>
        <textarea id="pertanyaan" name="pertanyaan" x-model="form.pertanyaan" rows="4" placeholder="Tulis pertanyaan di sini..."
          :class="errors.pertanyaan ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
          class="px-3 py-2.5 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
        <div x-show="errors.pertanyaan" x-text="errors.pertanyaan" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
        <div x-show="!errors.pertanyaan" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
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
              <input type="text" name="opsi_a" x-model="form.opsi_a" placeholder="Tulis opsi jawaban A..."
                :class="errors.opsi_a ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
              <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                <input type="radio" name="jawaban_benar" value="a" x-model="form.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
              </label>
            </div>

            {{-- Opsi B --}}
            <div class="flex items-center gap-3">
              <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">B</span>
              </div>
              <input type="text" name="opsi_b" x-model="form.opsi_b" placeholder="Tulis opsi jawaban B..."
                :class="errors.opsi_b ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
              <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                <input type="radio" name="jawaban_benar" value="b" x-model="form.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
              </label>
            </div>

            {{-- Opsi C --}}
            <div class="flex items-center gap-3">
              <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">C</span>
              </div>
              <input type="text" name="opsi_c" x-model="form.opsi_c" placeholder="Tulis opsi jawaban C..."
                :class="errors.opsi_c ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
              <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                <input type="radio" name="jawaban_benar" value="c" x-model="form.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
              </label>
            </div>

            {{-- Opsi D --}}
            <div class="flex items-center gap-3">
              <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">D</span>
              </div>
              <input type="text" name="opsi_d" x-model="form.opsi_d" placeholder="Tulis opsi jawaban D..."
                :class="errors.opsi_d ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
              <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                <input type="radio" name="jawaban_benar" value="d" x-model="form.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
              </label>
            </div>

          </div>
          <div x-show="optionGroupError" x-text="optionGroupError" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
          <div x-show="!optionGroupError" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Pilih satu opsi sebagai jawaban yang benar.
          </div>
        </div>
      </template>

      {{-- Skor & Status — hanya untuk Pilihan Ganda --}}
      <template x-if="isPilihanGanda">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
          <div class="flex flex-col gap-[7px]">
            <label for="skor" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Skor <span class="text-[#E53E3E]">*</span>
            </label>
            <input id="skor" type="number" name="skor" x-model="form.skor" placeholder="Contoh: 10" min="1"
              :class="errors.skor ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
              class="h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
            <div x-show="errors.skor" x-text="errors.skor" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
            <div x-show="!errors.skor" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Nilai poin untuk soal ini dalam paket tes.
            </div>
          </div>

          <div class="flex flex-col gap-[7px]">
            <label for="status-pg" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
              Status <span class="text-[#E53E3E]">*</span>
            </label>
            <div class="relative">
              <select id="status-pg" name="status" x-model="form.status"
                :class="errors.status ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                class="appearance-none h-[42px] w-full px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </div>
            </div>
            <div x-show="errors.status" x-text="errors.status" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
            <div x-show="!errors.status" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
              Soal nonaktif tidak akan muncul di paket tes.
            </div>
          </div>
        </div>
      </template>

      {{-- Status — hanya untuk Essay (tanpa skor) --}}
      <template x-if="isEssay">
        <div class="flex flex-col gap-[7px]">
          <label for="status-essay" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Status <span class="text-[#E53E3E]">*</span>
          </label>
          <div class="relative w-full max-w-sm">
            <select id="status-essay" name="status" x-model="form.status"
              :class="errors.status ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
              class="appearance-none h-[42px] w-full px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
              <option value="aktif">Aktif</option>
              <option value="nonaktif">Nonaktif</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
              <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
          <div x-show="errors.status" x-text="errors.status" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
          <div x-show="!errors.status" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Soal essay akan direview dan dinilai secara manual oleh Reviewer.
          </div>
        </div>
      </template>

      {{-- Keterangan (kedua tipe) --}}
      <div class="flex flex-col gap-[7px]">
        <label for="keterangan" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Keterangan <span class="text-[#A2B0BA] font-normal">(opsional)</span>
        </label>
        <textarea id="keterangan" name="keterangan" x-model="form.keterangan" rows="3" placeholder="Contoh: Rubrik penilaian tersedia, soal diperbarui dari versi sebelumnya..."
          :class="errors.keterangan ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
          class="px-3 py-2.5 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
        <div x-show="errors.keterangan" x-text="errors.keterangan" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
        <div x-show="!errors.keterangan" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
          Catatan internal untuk tim HR, tidak ditampilkan ke kandidat.
        </div>
      </div>

    </div>

    {{-- Form Footer --}}
    <div class="flex items-center justify-end h-[72px] shrink-0 gap-[10px] px-6 border-t border-[#EDF2F5]">
      <a href="{{ url('/hr/question-bank') }}"
        class="flex items-center h-10 px-[14px] bg-white border border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
        <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/[18px]">
          Batal
        </div>
      </a>
      <button type="submit" :disabled="loading"
        class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
        <svg x-show="!loading" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <polyline points="17 21 17 13 7 13 7 21" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <polyline points="7 3 7 8 15 8" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg x-show="loading" style="display: none;" class="animate-spin shrink-0" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="9" fill="none" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="3"/>
          <path d="M21 12a9 9 0 0 0-9-9" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]" x-text="loading ? 'Menyimpan...' : 'Simpan perubahan'">
          Simpan perubahan
        </div>
      </button>
    </div>

  </form>
</div>

@endsection

@push('scripts')
<script>
  function editSoalForm(initialData) {
    return {
      form: {
        id: initialData.id,
        category_id: initialData.category_id,
        category_name: initialData.category_name || '-',
        tipe: initialData.tipe || 'pilihan_ganda',
        pertanyaan: initialData.pertanyaan || '',
        opsi_a: initialData.opsi_a || '',
        opsi_b: initialData.opsi_b || '',
        opsi_c: initialData.opsi_c || '',
        opsi_d: initialData.opsi_d || '',
        jawaban_benar: initialData.jawaban_benar || '',
        skor: initialData.skor !== undefined && initialData.skor !== null ? initialData.skor : '',
        status: initialData.status || 'aktif',
        keterangan: initialData.keterangan || '',
      },
      errors: {},
      generalError: '',
      loading: false,

      get isPilihanGanda() {
        return this.form.tipe === 'pilihan_ganda';
      },

      get isEssay() {
        return this.form.tipe === 'essay';
      },

      get optionGroupError() {
        return (
          this.errors.opsi_a ||
          this.errors.opsi_b ||
          this.errors.opsi_c ||
          this.errors.opsi_d ||
          this.errors.jawaban_benar ||
          ''
        );
      },

      validate() {
        this.errors = {};
        this.generalError = '';

        if (!String(this.form.pertanyaan || '').trim()) {
          this.errors.pertanyaan = 'Pertanyaan wajib diisi.';
        }

        if (this.isPilihanGanda) {
          if (!String(this.form.opsi_a || '').trim()) {
            this.errors.opsi_a = 'Semua opsi jawaban (A, B, C, D) wajib diisi.';
          }
          if (!String(this.form.opsi_b || '').trim()) {
            this.errors.opsi_b = 'Semua opsi jawaban (A, B, C, D) wajib diisi.';
          }
          if (!String(this.form.opsi_c || '').trim()) {
            this.errors.opsi_c = 'Semua opsi jawaban (A, B, C, D) wajib diisi.';
          }
          if (!String(this.form.opsi_d || '').trim()) {
            this.errors.opsi_d = 'Semua opsi jawaban (A, B, C, D) wajib diisi.';
          }
          if (!this.form.jawaban_benar) {
            this.errors.jawaban_benar = 'Pilih satu jawaban yang benar.';
          }
          if (this.form.skor === '' || this.form.skor === null || Number(this.form.skor) < 1) {
            this.errors.skor = 'Skor minimal adalah 1.';
          }
        }

        if (!this.form.status) {
          this.errors.status = 'Status soal wajib dipilih.';
        }

        if (Object.keys(this.errors).length > 0) {
          this.generalError = 'Mohon lengkapi seluruh kolom wajib sebelum menyimpan perubahan.';
          return false;
        }

        return true;
      },

      async submit() {
        if (!this.validate() || this.loading) return;

        this.loading = true;
        try {
          const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
          const payload = {
            pertanyaan: String(this.form.pertanyaan).trim(),
            status: this.form.status,
            keterangan: this.form.keterangan ? String(this.form.keterangan).trim() : '',
          };

          if (this.isPilihanGanda) {
            payload.opsi_a = String(this.form.opsi_a).trim();
            payload.opsi_b = String(this.form.opsi_b).trim();
            payload.opsi_c = String(this.form.opsi_c).trim();
            payload.opsi_d = String(this.form.opsi_d).trim();
            payload.jawaban_benar = this.form.jawaban_benar;
            payload.skor = Number(this.form.skor);
          }

          const res = await fetch(`{{ url('/api/question-bank') }}/${this.form.id}`, {
            method: 'PUT',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify(payload),
          });

          const data = await res.json().catch(() => ({}));

          if (res.status === 422) {
            this.errors = Object.fromEntries(
              Object.entries(data.errors || {}).map(([k, v]) => [k, Array.isArray(v) ? v[0] : v])
            );
            this.generalError = data.message || 'Terdapat data soal yang belum lengkap atau tidak valid.';
            return;
          }

          if (!res.ok) {
            this.generalError = data.message || 'Gagal memperbarui soal. Silakan coba lagi.';
            return;
          }

          sessionStorage.setItem('bankSoalFlash', JSON.stringify({
            type: 'success',
            message: data.message || 'Soal berhasil diperbarui.',
          }));
          window.location.href = '{{ url('/hr/question-bank') }}';
        } catch (e) {
          this.generalError = 'Tidak dapat terhubung ke server. Periksa koneksi Anda.';
        } finally {
          this.loading = false;
        }
      },
    };
  }
</script>
@endpush


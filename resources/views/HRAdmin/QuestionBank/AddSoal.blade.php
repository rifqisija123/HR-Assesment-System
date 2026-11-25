@extends('layouts.hradmin')

@section('title', 'Tambah Soal')
@section('page_title', 'Tambah soal')

@section('content')

@php
  $rawCategories = $categories ?? \App\Models\QuestionCategory::withCount('questions')->orderBy('name')->get();
  if ($rawCategories instanceof \Illuminate\Database\Eloquent\Collection) {
      $rawCategories->loadCount('questions');
  }
  $categories = $rawCategories->filter(function ($cat) {
      $quota = max(1, (int) ($cat->total_questions ?? 0));
      $existing = (int) ($cat->questions_count ?? $cat->questions()->count());
      return $existing < $quota;
  })->values();

  $categoriesMeta = $categories->mapWithKeys(function ($cat) {
      $quota = max(1, (int) ($cat->total_questions ?? 0));
      $existing = (int) ($cat->questions_count ?? 0);
      $remaining = max(1, $quota - $existing);
      return [
          (string) $cat->id => [
              'id'              => $cat->id,
              'name'            => $cat->name,
              'tipe'            => $cat->type === 'essay' ? 'essay' : 'pilihan_ganda',
              'total_questions' => $remaining,
          ],
      ];
  });
@endphp

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

<div x-data="addSoalForm(@js($categoriesMeta))" class="flex flex-col mt-2">
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
    <div class="flex flex-col gap-1 pt-[22px] pb-[18px] px-6 border-b border-[#EDF2F5]">
      <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/[24px] tracking-[-0.015em]">
        Informasi soal
      </div>
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
        Pilih kategori terlebih dahulu untuk melanjutkan pengisian soal sesuai kuota jumlah soal pada kategori.
      </div>
    </div>

    {{-- Form Body --}}
    <div class="flex flex-col py-[22px] px-6 gap-[20px]">

      {{-- Step 1: Pilih Kategori --}}
      <div class="flex flex-col gap-[7px]">
        <label for="kategori" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Kategori <span class="text-[#E53E3E]">*</span>
        </label>
        <div class="relative">
          <select id="kategori" name="kategori" x-model="kategori" @change="onKategoriChange()"
            class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
            <option value="" disabled selected hidden>Pilih kategori soal</option>
            @foreach ($categories as $cat)
              <option value="{{ $cat->id }}">
                {{ $cat->name }} — {{ $cat->type === 'essay' ? 'Essay' : 'Pilihan Ganda' }}
              </option>
            @endforeach
          </select>
          <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
            <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
              <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
          Tipe soal (Pilihan Ganda / Essay) dan jumlah form soal ditentukan otomatis berdasarkan kategori yang dipilih.
        </div>

        {{-- Tipe & Jumlah Soal badge muncul setelah kategori dipilih --}}
        <div x-show="kategori" x-transition.opacity style="display:none;" class="flex flex-wrap items-center gap-3 mt-1">
          <div class="flex items-center gap-2">
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

          <div class="flex items-center gap-2">
            <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Jumlah soal wajib diisi:</span>
            <span class="inline-flex items-center justify-center bg-[#EDF2F5] rounded-[6px] h-6 px-3">
              <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[11px]/[16px] font-bold" x-text="jumlahSoal + ' Soal'"></span>
            </span>
          </div>
        </div>
      </div>

      {{-- Daftar Form Soal sesuai jumlah soal pada kategori yang dipilih --}}
      <template x-if="kategori && questions.length > 0">
        <div class="flex flex-col gap-6 pt-2 border-t border-[#EDF2F5]">

          <template x-for="(soal, idx) in questions" :key="kategori + '-soal-' + idx">
            <div class="flex flex-col rounded-[12px] border border-[#DDE6ED] bg-[#F8FAFC]/50 overflow-hidden">

              {{-- Header per Nomor Soal (tidak dapat dikurangi) --}}
              <div class="flex items-center justify-between px-5 py-3.5 bg-[#F3F7F9] border-b border-[#DDE6ED]">
                <div class="flex items-center gap-2.5">
                  <span class="inline-flex items-center justify-center h-6 px-2.5 rounded-[6px] bg-[#147D92] text-white font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold" x-text="'Soal #' + (idx + 1)"></span>
                  <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#102A43] text-[13px]/[18px]" x-text="selectedCategory?.name || ''"></span>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-medium text-[#62798A]" x-text="'Pertanyaan ' + (idx + 1) + ' dari ' + jumlahSoal"></div>
              </div>

              {{-- Body per Nomor Soal --}}
              <div class="flex flex-col p-5 gap-[18px] bg-white">

                {{-- Pertanyaan (kedua tipe) --}}
                <div class="flex flex-col gap-[7px]">
                  <label :for="'pertanyaan-' + idx" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                    Pertanyaan <span x-text="idx + 1"></span> <span class="text-[#E53E3E]">*</span>
                  </label>
                  <textarea :id="'pertanyaan-' + idx" :name="'questions[' + idx + '][pertanyaan]'" x-model="soal.pertanyaan" rows="4" :placeholder="'Tulis pertanyaan untuk soal #' + (idx + 1) + ' di sini...'"
                    :class="getFieldError(idx, 'pertanyaan') ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                    class="px-3 py-2.5 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
                  <div x-show="getFieldError(idx, 'pertanyaan')" x-text="getFieldError(idx, 'pertanyaan')" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
                  <div x-show="!getFieldError(idx, 'pertanyaan')" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
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
                        <input type="text" :name="'questions[' + idx + '][opsi_a]'" x-model="soal.opsi_a" placeholder="Tulis opsi jawaban A..."
                          :class="getFieldError(idx, 'opsi_a') ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                          class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                        <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                          <input type="radio" :name="'questions[' + idx + '][jawaban_benar]'" value="a" x-model="soal.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                          <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                        </label>
                      </div>

                      {{-- Opsi B --}}
                      <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                          <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">B</span>
                        </div>
                        <input type="text" :name="'questions[' + idx + '][opsi_b]'" x-model="soal.opsi_b" placeholder="Tulis opsi jawaban B..."
                          :class="getFieldError(idx, 'opsi_b') ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                          class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                        <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                          <input type="radio" :name="'questions[' + idx + '][jawaban_benar]'" value="b" x-model="soal.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                          <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                        </label>
                      </div>

                      {{-- Opsi C --}}
                      <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                          <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">C</span>
                        </div>
                        <input type="text" :name="'questions[' + idx + '][opsi_c]'" x-model="soal.opsi_c" placeholder="Tulis opsi jawaban C..."
                          :class="getFieldError(idx, 'opsi_c') ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                          class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                        <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                          <input type="radio" :name="'questions[' + idx + '][jawaban_benar]'" value="c" x-model="soal.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                          <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                        </label>
                      </div>

                      {{-- Opsi D --}}
                      <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center shrink-0 size-[30px] rounded-full border-2 border-[#DDE6ED] bg-[#F8FAFC]">
                          <span class="font-['Inter',system-ui,sans-serif] font-bold text-[#486174] text-[12px]/[16px]">D</span>
                        </div>
                        <input type="text" :name="'questions[' + idx + '][opsi_d]'" x-model="soal.opsi_d" placeholder="Tulis opsi jawaban D..."
                          :class="getFieldError(idx, 'opsi_d') ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                          class="flex-1 h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors">
                        <label class="flex items-center gap-2 shrink-0 cursor-pointer">
                          <input type="radio" :name="'questions[' + idx + '][jawaban_benar]'" value="d" x-model="soal.jawaban_benar" class="accent-[#147D92] cursor-pointer w-4 h-4">
                          <span class="font-['Inter',system-ui,sans-serif] text-[12px]/[16px] text-[#62798A]">Benar</span>
                        </label>
                      </div>

                    </div>
                    <div x-show="getOptionGroupError(idx)" x-text="getOptionGroupError(idx)" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
                    <div x-show="!getOptionGroupError(idx)" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
                      Pilih satu opsi sebagai jawaban yang benar.
                    </div>
                  </div>
                </template>

                {{-- Skor & Status — hanya untuk Pilihan Ganda --}}
                <template x-if="isPilihanGanda">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col gap-[7px]">
                      <label :for="'skor-' + idx" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                        Skor <span class="text-[#E53E3E]">*</span>
                      </label>
                      <input :id="'skor-' + idx" type="number" :name="'questions[' + idx + '][skor]'" x-model="soal.skor" placeholder="Contoh: 10" min="1"
                        :class="getFieldError(idx, 'skor') ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
                        class="h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
                      <div x-show="getFieldError(idx, 'skor')" x-text="getFieldError(idx, 'skor')" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
                      <div x-show="!getFieldError(idx, 'skor')" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
                        Nilai poin untuk soal ini dalam paket tes.
                      </div>
                    </div>
                    <div class="flex flex-col gap-[7px]">
                      <label :for="'status-pg-' + idx" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                        Status <span class="text-[#E53E3E]">*</span>
                      </label>
                      <div class="relative">
                        <select :id="'status-pg-' + idx" :name="'questions[' + idx + '][status]'" x-model="soal.status"
                          class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                          <option value="aktif">Aktif</option>
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
                    <label :for="'status-essay-' + idx" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                      Status <span class="text-[#E53E3E]">*</span>
                    </label>
                    <div class="relative w-full max-w-sm">
                      <select :id="'status-essay-' + idx" :name="'questions[' + idx + '][status]'" x-model="soal.status"
                        class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                        <option value="aktif">Aktif</option>
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
                  <label :for="'keterangan-' + idx" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
                    Keterangan <span class="text-[#A2B0BA] font-normal">(opsional)</span>
                  </label>
                  <textarea :id="'keterangan-' + idx" :name="'questions[' + idx + '][keterangan]'" x-model="soal.keterangan" rows="3" placeholder="Contoh: Rubrik penilaian tersedia, soal diperbarui dari versi sebelumnya..."
                    class="px-3 py-2.5 rounded-[9px] border border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
                    Catatan internal untuk tim HR, tidak ditampilkan ke kandidat.
                  </div>
                </div>

              </div>
            </div>
          </template>

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
      <button type="submit" :disabled="!kategori || loading"
        class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
        <svg x-show="!loading" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg x-show="loading" style="display: none;" class="animate-spin shrink-0" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="9" fill="none" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="3"/>
          <path d="M21 12a9 9 0 0 0-9-9" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]" x-text="loading ? 'Menyimpan...' : (jumlahSoal > 1 ? 'Simpan ' + jumlahSoal + ' soal' : 'Simpan soal')">
          Simpan soal
        </div>
      </button>
    </div>

  </form>
</div>

@endsection

@push('scripts')
<script>
  function addSoalForm(categoriesMeta) {
    return {
      kategori: '',
      categoriesMeta: categoriesMeta || {},
      questions: [],
      errors: {},
      generalError: '',
      loading: false,

      get selectedCategory() {
        return this.kategori ? (this.categoriesMeta[String(this.kategori)] || null) : null;
      },

      get tipe() {
        return this.selectedCategory ? this.selectedCategory.tipe : '';
      },

      get jumlahSoal() {
        return this.selectedCategory ? Number(this.selectedCategory.total_questions || 1) : 0;
      },

      get isPilihanGanda() {
        return this.tipe === 'pilihan_ganda';
      },

      get isEssay() {
        return this.tipe === 'essay';
      },

      createEmptyQuestion() {
        return {
          pertanyaan: '',
          opsi_a: '',
          opsi_b: '',
          opsi_c: '',
          opsi_d: '',
          jawaban_benar: '',
          skor: '',
          status: 'aktif',
          keterangan: '',
        };
      },

      onKategoriChange() {
        this.errors = {};
        this.generalError = '';
        const total = this.jumlahSoal;
        if (!total || total <= 0) {
          this.questions = [];
          return;
        }
        this.questions = Array.from({ length: total }, () => this.createEmptyQuestion());
      },

      getFieldError(idx, field) {
        return this.errors[`questions.${idx}.${field}`] || '';
      },

      getOptionGroupError(idx) {
        return (
          this.getFieldError(idx, 'opsi_a') ||
          this.getFieldError(idx, 'opsi_b') ||
          this.getFieldError(idx, 'opsi_c') ||
          this.getFieldError(idx, 'opsi_d') ||
          this.getFieldError(idx, 'jawaban_benar') ||
          ''
        );
      },

      validate() {
        this.errors = {};
        this.generalError = '';

        if (!this.kategori) {
          this.generalError = 'Pilih kategori soal terlebih dahulu.';
          return false;
        }

        this.questions.forEach((soal, idx) => {
          if (!String(soal.pertanyaan || '').trim()) {
            this.errors[`questions.${idx}.pertanyaan`] = `Pertanyaan untuk Soal #${idx + 1} wajib diisi.`;
          }
          if (this.isPilihanGanda) {
            if (!String(soal.opsi_a || '').trim()) {
              this.errors[`questions.${idx}.opsi_a`] = `Semua opsi jawaban (A, B, C, D) pada Soal #${idx + 1} wajib diisi.`;
            }
            if (!String(soal.opsi_b || '').trim()) {
              this.errors[`questions.${idx}.opsi_b`] = `Semua opsi jawaban (A, B, C, D) pada Soal #${idx + 1} wajib diisi.`;
            }
            if (!String(soal.opsi_c || '').trim()) {
              this.errors[`questions.${idx}.opsi_c`] = `Semua opsi jawaban (A, B, C, D) pada Soal #${idx + 1} wajib diisi.`;
            }
            if (!String(soal.opsi_d || '').trim()) {
              this.errors[`questions.${idx}.opsi_d`] = `Semua opsi jawaban (A, B, C, D) pada Soal #${idx + 1} wajib diisi.`;
            }
            if (!soal.jawaban_benar) {
              this.errors[`questions.${idx}.jawaban_benar`] = `Pilih satu jawaban yang benar untuk Soal #${idx + 1}.`;
            }
            if (soal.skor === '' || soal.skor === null || Number(soal.skor) < 1) {
              this.errors[`questions.${idx}.skor`] = `Skor pada Soal #${idx + 1} minimal 1.`;
            }
          }
        });

        if (Object.keys(this.errors).length > 0) {
          this.generalError = 'Mohon lengkapi seluruh kolom wajib pada setiap nomor soal sebelum menyimpan.';
          return false;
        }

        return true;
      },

      async submit() {
        if (!this.validate() || this.loading) return;

        this.loading = true;
        try {
          const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
          const res = await fetch('{{ url('/api/question-bank') }}', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({
              kategori: this.kategori,
              questions: this.questions,
            }),
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
            this.generalError = data.message || 'Gagal menyimpan soal ke bank soal. Silakan coba lagi.';
            return;
          }

          sessionStorage.setItem('bankSoalFlash', JSON.stringify({
            type: 'success',
            message: data.message || 'Soal berhasil ditambahkan ke Bank Soal.',
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

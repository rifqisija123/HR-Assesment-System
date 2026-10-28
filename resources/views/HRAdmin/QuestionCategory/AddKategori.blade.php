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

<div class="flex flex-col mt-2" x-data="addKategoriForm()">
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
        <label for="nama_kategori" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Nama kategori <span class="text-[#E53E3E]">*</span>
        </label>
        <input type="text" id="nama_kategori" name="nama_kategori" x-model="form.nama_kategori" required placeholder="Contoh: Logika & Penalaran"
          :class="errors.nama_kategori ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
          class="h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
        <div x-show="errors.nama_kategori" x-text="errors.nama_kategori" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
        <div x-show="!errors.nama_kategori" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
          Gunakan nama yang jelas dan mudah dipahami oleh tim HR.
        </div>
      </div>

      {{-- Deskripsi --}}
      <div class="flex flex-col gap-[7px]">
        <label for="deskripsi" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
          Deskripsi <span class="text-[#A2B0BA] font-normal">(opsional)</span>
        </label>
        <textarea id="deskripsi" name="deskripsi" rows="4" x-model="form.deskripsi" placeholder="Tuliskan penjelasan singkat mengenai jenis soal pada kategori ini..."
          :class="errors.deskripsi ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
          class="px-3 py-2.5 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full resize-none"></textarea>
        <div x-show="errors.deskripsi" x-text="errors.deskripsi" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
        <div x-show="!errors.deskripsi" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
          Jelaskan tujuan dan cakupan topik kategori ini.
        </div>
      </div>

      {{-- Jumlah Soal, Tipe & Status (3 kolom) --}}
      <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- Jumlah Soal --}}
        <div class="flex flex-col gap-[7px]">
          <label for="jumlah_soal" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Jumlah soal <span class="text-[#E53E3E]">*</span>
          </label>
          <input type="number" id="jumlah_soal" name="jumlah_soal" x-model="form.jumlah_soal" placeholder="0" min="0"
            :class="errors.jumlah_soal ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
            class="h-[42px] px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
          <div x-show="errors.jumlah_soal" x-text="errors.jumlah_soal" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
          <div x-show="!errors.jumlah_soal" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Tentukan kuota/target soal untuk kategori ini.
          </div>
        </div>

        {{-- Tipe Soal --}}
        <div class="flex flex-col gap-[7px]">
          <label for="tipe" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Tipe soal <span class="text-[#E53E3E]">*</span>
          </label>
          <div class="relative">
            <select id="tipe" name="tipe" x-model="form.tipe" required
              :class="errors.tipe ? 'border-[#E53E3E] ring-1 ring-[#E53E3E]' : 'border-[#DDE6ED]'"
              class="appearance-none h-[42px] w-full px-3 rounded-[9px] border bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
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
          <div x-show="errors.tipe" x-text="errors.tipe" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-[12px]/[16px]"></div>
          <div x-show="!errors.tipe" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[12px]/[16px]">
            Pilihan ganda untuk soal objektif, essay untuk soal uraian.
          </div>
        </div>

        {{-- Status --}}
        <div class="flex flex-col gap-[7px]">
          <label for="status" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[12px]/[16px]">
            Status kategori <span class="text-[#E53E3E]">*</span>
          </label>
          <div class="relative">
            <select id="status" name="status" x-model="form.status" required
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
      <button type="submit" :disabled="loading"
        class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors disabled:opacity-70 disabled:cursor-wait">
        <svg x-show="!loading" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
          <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <svg x-show="loading" style="display: none;" class="animate-spin shrink-0" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="9" fill="none" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="3"/>
          <path d="M21 12a9 9 0 0 0-9-9" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
        </svg>
        <div class="font-['Inter',system-ui,sans-serif] font-[650] text-white text-[13px]/[18px]" x-text="loading ? 'Menyimpan...' : 'Simpan kategori'">
          Simpan kategori
        </div>
      </button>
    </div>

  </form>
</div>

@endsection

@push('scripts')
<script>
  function addKategoriForm() {
    return {
      form: {
        nama_kategori: '',
        deskripsi: '',
        jumlah_soal: 0,
        tipe: '',
        status: 'aktif',
      },
      errors: {},
      generalError: '',
      loading: false,

      validate() {
        this.errors = {};
        if (!String(this.form.nama_kategori || '').trim()) {
          this.errors.nama_kategori = 'Nama kategori wajib diisi.';
        }
        if (this.form.jumlah_soal === '' || this.form.jumlah_soal === null || Number(this.form.jumlah_soal) < 0) {
          this.errors.jumlah_soal = 'Jumlah soal minimal 0.';
        }
        if (!this.form.tipe) {
          this.errors.tipe = 'Tipe soal wajib dipilih.';
        }
        if (!this.form.status) {
          this.errors.status = 'Status kategori wajib dipilih.';
        }
        return Object.keys(this.errors).length === 0;
      },

      async submit() {
        this.generalError = '';
        if (!this.validate() || this.loading) return;

        this.loading = true;
        try {
          const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
          const res = await fetch('{{ url('/api/question-categories') }}', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': token,
            },
            body: JSON.stringify({
              nama_kategori: String(this.form.nama_kategori).trim(),
              deskripsi: this.form.deskripsi ? String(this.form.deskripsi).trim() : '',
              jumlah_soal: Number(this.form.jumlah_soal) || 0,
              tipe: this.form.tipe,
              status: this.form.status,
            }),
          });

          const data = await res.json().catch(() => ({}));

          if (res.status === 422) {
            this.errors = Object.fromEntries(
              Object.entries(data.errors || {}).map(([k, v]) => [k, Array.isArray(v) ? v[0] : v])
            );
            if (!Object.keys(this.errors).length && data.message) {
              this.generalError = data.message;
            }
            return;
          }

          if (!res.ok) {
            this.generalError = data.message || 'Gagal menambahkan kategori soal. Silakan coba lagi.';
            return;
          }

          sessionStorage.setItem('kategoriFlash', JSON.stringify({
            type: 'success',
            message: data.message || 'Kategori soal berhasil ditambahkan.',
          }));
          window.location.href = '{{ url('/hr/question-categories') }}';
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

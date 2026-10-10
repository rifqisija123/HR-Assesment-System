@extends('layouts.superadmin')
@section('title', 'Edit Pengguna')
@section('page_title', 'Edit pengguna')

@section('content')
<!-- Content Area -->
<div class="flex flex-col grow basis-[0%] min-w-0 pt-[38px] pb-10 gap-6 px-10 bg-[#F7F9FC]">
  <div class="flex items-end justify-between gap-6">
    <div class="flex flex-col gap-2">
      <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
        AKSES & PERAN
      </div>
      <div class="tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
        Edit pengguna
      </div>
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
        Perbarui informasi akun pengguna dan atur peran sistem.
      </div>
    </div>
    <a href="{{ url('/usermanagement') }}" class="h-10 flex items-center px-[13px] rounded-[9px] gap-2 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
      <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
        <path d="m15 18-6-6 6-6" fill="none" stroke="#486174" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/4.5">
        Kembali
      </div>
    </a>
  </div>

  <div class="flex flex-col grow basis-[0%] mt-2">
    <form id="edit-user-form" x-data="editUserForm(@js($userData))" @submit.prevent="submit" novalidate class="flex flex-col w-full shrink-0 overflow-clip bg-white border border-solid border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1.25 pt-[22px] pb-[18px] px-6 border-b border-b-solid border-b-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/6 tracking-[-0.015em]">
          Informasi pengguna
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
          Perbarui data pengguna di bawah ini.
        </div>
      </div>

      <div class="flex flex-col grow basis-[0%] py-[22px] px-6 gap-[18px]">
        <!-- General error -->
        <div x-show="generalError" x-transition.opacity style="display: none;" class="flex items-start gap-2.5 px-4 py-3 rounded-[10px] bg-[#FEF2F2] border border-solid border-[#FBD5D5] font-['Inter',system-ui,sans-serif] text-[13px]/5 text-[#C53030]">
          <svg width="16" height="16" viewBox="0 0 24 24" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10" fill="none" stroke="#C53030" stroke-width="2"/><path d="M12 8v4M12 16h.01" stroke="#C53030" stroke-width="2" stroke-linecap="round"/></svg>
          <span x-text="generalError"></span>
        </div>

        <!-- Nama Lengkap -->
        <div class="flex flex-col gap-[7px]">
          <label for="user-name" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
            Nama lengkap <span class="text-red-600">*</span>
          </label>
          <input id="user-name" name="name" type="text" x-model.trim="form.name" placeholder="Contoh: Nadia Putri" :class="errors.name ? 'border-[#E53E3E]' : 'border-[#DDE6ED]'" class="h-[42px] px-3 rounded-[9px] border border-solid bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
          <div x-show="errors.name" x-text="errors.name" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-xs/4"></div>
        </div>

        <!-- Alamat Email (Hanya jika pengguna BELUM membuat password / terverifikasi) -->
        <template x-if="form.invite_pending">
          <div class="flex flex-col gap-[7px]">
            <label for="user-email" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
              Alamat email <span class="text-red-600">*</span>
            </label>
            <input id="user-email" name="email" type="email" x-model.trim="form.email" placeholder="nama@perusahaan.com" :class="errors.email ? 'border-[#E53E3E]' : 'border-[#DDE6ED]'" class="h-[42px] px-3 rounded-[9px] border border-solid bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
            <div x-show="errors.email" x-text="errors.email" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-xs/4"></div>
          </div>
        </template>

        <div class="grid grid-cols-2 gap-5">
          <!-- Role -->
          <div class="flex flex-col gap-[7px]">
            <label for="user-role" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
              Role <span class="text-red-600">*</span>
            </label>
            <div class="relative">
              <select id="user-role" name="role" x-model="form.role" :class="errors.role ? 'border-[#E53E3E]' : 'border-[#DDE6ED]'" class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-solid bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="" disabled selected hidden>Pilih role pengguna</option>
                <option value="super_admin">Super Admin</option>
                <option value="hr_admin">HR Admin</option>
                <option value="reviewer">Reviewer</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <div x-show="errors.role" x-text="errors.role" style="display: none;" class="font-['Inter',system-ui,sans-serif] text-[#E53E3E] text-xs/4 mt-0.5"></div>
            <div x-show="!errors.role" class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4 mt-0.5">
              Pilih HR Admin, Reviewer, atau Super Admin.
            </div>
          </div>

          <!-- Status -->
          <div class="flex flex-col gap-[7px]">
            <label for="user-status" class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
              Status <span class="text-red-600">*</span>
            </label>
            <div class="relative">
              <select id="user-status" name="status" x-model="form.status" class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-solid border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4 mt-0.5">
              Status akun dapat diubah sewaktu-waktu.
            </div>
          </div>
        </div>

        <!-- Checkbox Kirim Undangan Akses (Hanya jika pengguna BELUM membuat password / terverifikasi) -->
        <template x-if="form.invite_pending">
          <label id="send-invite-toggle" class="flex items-start gap-[11px] p-[14px] bg-[#FAFCFD] border border-solid border-[#DDE6ED] rounded-[11px] mt-2 cursor-pointer select-none" @click.prevent="form.send_invite = !form.send_invite">
            <input type="checkbox" class="hidden" x-bind:checked="form.send_invite" name="send_invite" />
            <div :class="form.send_invite ? 'bg-[#147D92] border-[#147D92]' : 'bg-white border-[#DDE6ED]'" class="flex items-center justify-center h-[18px] w-[18px] shrink-0 border border-solid rounded-[5px] mt-0.5 transition-colors">
              <svg x-show="form.send_invite" style="display: none;" width="13" height="13" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                <path d="m5 12 4 4L19 6" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="flex flex-col gap-1">
              <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                Kirim ulang undangan akses
              </div>
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[12px]/[17px]">
                Pengguna menerima email baru untuk membuat password dan masuk ke sistem.
              </div>
            </div>
          </label>
        </template>
      </div>

      <div class="flex items-center justify-end h-[72px] shrink-0 gap-[10px] px-6 border-t border-t-solid border-t-[#EDF2F5]">
        <a href="{{ url('/usermanagement') }}" class="flex items-center h-10 px-[14px] bg-white border border-solid border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
          <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/4.5">
            Batal
          </div>
        </a>
        <button id="edit-user-submit" type="submit" :disabled="loading" class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors disabled:opacity-70 disabled:cursor-wait">
          <svg x-show="!loading" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <polyline points="17 21 17 13 7 13 7 21" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <polyline points="7 3 7 8 15 8" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg x-show="loading" style="display: none;" class="animate-spin" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="9" fill="none" stroke="#FFFFFF" stroke-opacity="0.35" stroke-width="3" />
            <path d="M21 12a9 9 0 0 0-9-9" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" />
          </svg>
          <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-[13px]/4.5" x-text="loading ? 'Menyimpan...' : 'Simpan perubahan'">
            Simpan perubahan
          </div>
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function editUserForm(initialData) {
    return {
      form: {
        id: initialData.id,
        name: initialData.name || '',
        email: initialData.email || '',
        role: initialData.role || '',
        status: initialData.status || 'aktif',
        invite_pending: Boolean(initialData.invite_pending),
        send_invite: false,
      },
      errors: {},
      generalError: '',
      loading: false,

      validate() {
        this.errors = {};
        if (!this.form.name) this.errors.name = 'Nama lengkap wajib diisi.';
        if (this.form.invite_pending) {
          if (!this.form.email) this.errors.email = 'Alamat email wajib diisi.';
          else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) this.errors.email = 'Format email tidak valid.';
        }
        if (!this.form.role) this.errors.role = 'Role wajib dipilih.';
        return Object.keys(this.errors).length === 0;
      },

      async submit() {
        this.generalError = '';
        if (!this.validate() || this.loading) return;

        this.loading = true;
        try {
          const res = await fetch(`{{ url('/api/users') }}/${this.form.id}`, {
            method: 'PUT',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify(this.form),
          });
          const data = await res.json().catch(() => ({}));

          if (res.status === 422) {
            this.errors = Object.fromEntries(
              Object.entries(data.errors || {}).map(([k, v]) => [k, Array.isArray(v) ? v[0] : v])
            );
            return;
          }
          if (!res.ok) {
            this.generalError = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
            return;
          }

          sessionStorage.setItem('userFlash', JSON.stringify({
            type: data.invite_error ? 'warning' : 'success',
            message: data.message || 'Pengguna berhasil diperbarui.',
          }));
          window.location.href = '{{ url('/usermanagement') }}';
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

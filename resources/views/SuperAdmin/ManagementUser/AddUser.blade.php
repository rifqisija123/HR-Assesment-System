@extends('layouts.superadmin')
@section('title', 'Tambah Pengguna')
@section('page_title', 'Tambah pengguna')

@section('content')
<!-- Content Area -->
<div class="flex flex-col grow basis-[0%] min-w-0 pt-[38px] pb-10 gap-6 px-10 bg-[#F7F9FC]">
  <div class="flex items-end justify-between gap-6">
    <div class="flex flex-col gap-2">
      <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
        AKSES & PERAN
      </div>
      <div class="tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
        Tambah pengguna
      </div>
      <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
        Buat akses baru untuk HR Admin, Reviewer, atau Super Admin.
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
    <form class="flex flex-col w-full shrink-0 overflow-clip bg-white border border-solid border-[#DDE6ED] rounded-[14px]">
      <div class="flex flex-col gap-1.25 pt-[22px] pb-[18px] px-6 border-b border-b-solid border-b-[#EDF2F5]">
        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[18px]/6 tracking-[-0.015em]">
          Informasi pengguna
        </div>
        <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/[19px]">
          Lengkapi data di bawah untuk memberikan akses ke sistem.
        </div>
      </div>

      <div class="flex flex-col grow basis-[0%] py-[22px] px-6 gap-[18px]">
        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
            Nama lengkap
          </label>
          <input type="text" placeholder="Contoh: Nadia Putri" class="h-[42px] px-3 rounded-[9px] border border-solid border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
        </div>

        <div class="flex flex-col gap-[7px]">
          <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
            Alamat email
          </label>
          <input type="email" placeholder="nama@perusahaan.com" class="h-[42px] px-3 rounded-[9px] border border-solid border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#102A43] placeholder-[#A2B0BA] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors w-full">
        </div>

        <div class="grid grid-cols-2 gap-5">
          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
              Role
            </label>
            <div class="relative">
              <select class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-solid border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="" disabled selected hidden>Pilih role pengguna</option>
                <option value="Super Admin">Super Admin</option>
                <option value="HR Admin">HR Admin</option>
                <option value="Reviewer">Reviewer</option>
              </select>
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                  <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </div>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4 mt-0.5">
              Pilih HR Admin, Reviewer, atau Super Admin.
            </div>
          </div>

          <div class="flex flex-col gap-[7px]">
            <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
              Status
            </label>
            <div class="relative">
              <select class="appearance-none h-[42px] w-full px-3 rounded-[9px] border border-solid border-[#DDE6ED] bg-white font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] focus:outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] transition-colors cursor-pointer">
                <option value="aktif" selected>Aktif</option>
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

        <label x-data="{ checked: true }" class="flex items-start gap-[11px] p-[14px] bg-[#FAFCFD] border border-solid border-[#DDE6ED] rounded-[11px] mt-2 cursor-pointer select-none" @click.prevent="checked = !checked">
          <input type="checkbox" class="hidden" x-bind:checked="checked" name="send_invite" />
          <div :class="checked ? 'bg-[#147D92] border-[#147D92]' : 'bg-white border-[#DDE6ED]'" class="flex items-center justify-center h-[18px] w-[18px] shrink-0 border border-solid rounded-[5px] mt-0.5 transition-colors">
            <svg x-show="checked" style="display: none;" width="13" height="13" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
              <path d="m5 12 4 4L19 6" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
          </div>
          <div class="flex flex-col gap-1">
            <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
              Kirim undangan akses
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[12px]/[17px]">
              Pengguna menerima email untuk membuat kata sandi dan masuk ke sistem.
            </div>
          </div>
        </label>
      </div>

      <div class="flex items-center justify-end h-[72px] shrink-0 gap-[10px] px-6 border-t border-t-solid border-t-[#EDF2F5]">
        <a href="{{ url('/usermanagement') }}" class="flex items-center h-10 px-[14px] bg-white border border-solid border-[#DDE6ED] rounded-[9px] cursor-pointer hover:bg-gray-50 transition-colors no-underline">
          <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]/4.5">
            Batal
          </div>
        </a>
        <button type="submit" class="flex items-center h-10 px-[14px] gap-2 bg-[#147D92] rounded-[9px] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
          <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
            <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-[13px]/4.5">
            Buat pengguna
          </div>
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

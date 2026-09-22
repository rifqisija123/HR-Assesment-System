@extends('layouts.superadmin')
@section('title', 'Manajemen Pengguna')
@section('page_title', 'Manajemen pengguna')

@section('content')
        <!-- Content Area -->
        <div class="flex flex-col grow basis-[0%] min-w-0 pt-[38px] pb-10 gap-6 px-10 bg-[#F7F9FC]">
          <div class="flex items-end justify-between gap-6">
            <div class="flex flex-col gap-2">
              <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
                AKSES & PERAN
              </div>
              <div class="tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
                Manajemen pengguna
              </div>
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
                Buat akses, atur peran, dan kelola status akun administratif.
              </div>
            </div>
            <a href="{{ url('/usermanagement/add') }}" class="h-[42px] flex items-center shrink-0 px-4 rounded-[10px] gap-[9px] bg-[#147D92] cursor-pointer hover:bg-[#116a7c] transition-colors border-none no-underline">
              <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
                <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
              </svg>
              <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-sm/5">
                Tambah pengguna
              </div>
            </a>
          </div>
          
          <!-- Table Card -->
          <div class="flex flex-col rounded-[14px] overflow-hidden bg-white border border-solid border-[#DDE6ED]">
            
            <!-- Table Toolbar -->
            <div class="h-[76px] flex items-center justify-between py-4 px-5 gap-4 shrink-0 border-b border-b-solid border-b-[#EDF2F5]">
              <div class="w-[328px] h-10 flex items-center px-3 rounded-[10px] gap-2.5 shrink-0 border border-solid border-[#DDE6ED] focus-within:border-[#147D92] transition-colors">
                <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                  <circle cx="11" cy="11" r="7" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="m20 20-4-4" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <input type="text" placeholder="Cari nama atau email..." class="font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 bg-transparent border-none outline-none w-full placeholder:text-[#92A4B0]" />
              </div>
              <div class="flex gap-2.5">
                <div class="relative">
                  <select class="appearance-none h-10 w-full pl-3 pr-10 rounded-[10px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/4.5 outline-none focus:border-[#147D92]">
                    <option value="">Semua role</option>
                    <option value="Super Admin">Super Admin</option>
                    <option value="HR Admin">HR Admin</option>
                    <option value="Reviewer">Reviewer</option>
                  </select>
                  <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
                <div class="relative">
                  <select class="appearance-none h-10 w-full pl-3 pr-10 rounded-[10px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/4.5 outline-none focus:border-[#147D92]">
                    <option value="">Semua status</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Nonaktif">Nonaktif</option>
                  </select>
                  <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
            </div>
            
            <!-- Table Header -->
            <div class="h-[42px] flex items-center px-5 shrink-0 bg-[#F3F7F9]">
              <div class="grow basis-[0%] min-w-0 tracking-[0.07em] font-['Inter',system-ui,sans-serif] font-bold text-[#62798A] text-[11px]/4">
                PENGGUNA
              </div>
              <div class="w-[170px] shrink-0 tracking-[0.07em] font-['Inter',system-ui,sans-serif] font-bold text-[#62798A] text-[11px]/4">
                ROLE
              </div>
              <div class="w-[150px] shrink-0 tracking-[0.07em] font-['Inter',system-ui,sans-serif] font-bold text-[#62798A] text-[11px]/4">
                STATUS
              </div>
              <div class="w-[160px] shrink-0 tracking-[0.07em] font-['Inter',system-ui,sans-serif] font-bold text-[#62798A] text-[11px]/4">
                AKTIVITAS TERAKHIR
              </div>
              <div class="w-[38px] shrink-0"></div>
            </div>
            
            <div class="flex flex-col max-h-[500px] overflow-y-auto overflow-x-hidden styled-scrollbar">
            <!-- Table Row 1 -->
            <div x-data="{ expanded: false, menuOpen: false, perms: { p1: true, p2: true, p3: true }, get allChecked() { return this.perms.p1 && this.perms.p2 && this.perms.p3; }, toggleAll() { let val = !this.allChecked; this.perms.p1 = val; this.perms.p2 = val; this.perms.p3 = val; } }" class="flex flex-col border-b border-b-solid border-[#EDF2F5]">
              <div class="h-[70px] flex items-center px-5 shrink-0 hover:bg-[#F9FBFC] transition-colors cursor-pointer" @click="expanded = !expanded">
              <div class="flex items-center grow basis-[0%] min-w-0 gap-[11px]">
                <div class="flex items-center justify-center shrink-0 rounded-[18px] bg-[#D7EEF3] size-9">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#11647A] text-xs/4">
                    RM
                  </div>
                </div>
                <div class="flex flex-col min-w-0 gap-0.5">
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                    Rizky Mahendra
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                    rizky@verta.co.id
                  </div>
                </div>
              </div>
              <div class="w-[170px] shrink-0">
                <div class="h-6 w-[94px] flex items-center justify-center rounded-md bg-[#E7EEF9]">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#3B5B93] text-[11px]/4">
                    Super Admin
                  </div>
                </div>
              </div>
              <div class="w-[150px] flex items-center shrink-0">
                <div class="h-6 flex items-center px-[9px] rounded-xl gap-1.5 bg-[#E7F6EE]">
                  <div class="rounded-[3px] shrink-0 bg-[#198754] size-1.5"></div>
                  <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#19734A] text-[11px]/4">
                    Aktif
                  </div>
                </div>
              </div>
              <div class="w-[160px] shrink-0 font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                Baru saja
              </div>
              <div class="w-auto flex items-center justify-end gap-2 shrink-0 relative">
                <!-- Dropdown Trigger -->
                <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded hover:bg-gray-200 transition-colors">
                  <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <circle cx="5" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="12" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="19" cy="12" r="1.5" fill="#7890A0" />
                  </svg>
                </button>
                
                <!-- Arrow Expand Button -->
                <button type="button" class="bg-transparent border-none p-1 rounded hover:bg-[#E2F4F3] transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition-transform duration-200 stroke-[#7890A0]" :class="expanded ? 'rotate-90 stroke-[#147D92]' : ''">
                    <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-[40px] top-8 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-10 overflow-hidden flex flex-col py-1">
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit
                  </button>
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Hapus
                  </button>
                </div>
              </div>
            </div>
            <!-- Expanded Area -->
            <div x-show="expanded" x-transition.opacity.duration.200ms class="bg-[#F8FAFC] border-t border-t-solid border-[#EDF2F5] px-5 py-6" style="display: none;">
              <div class="flex justify-end w-full mb-6 pr-7">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" @change="toggleAll()" :checked="allChecked" class="rounded-[4px] border-[#DDE6ED] text-[#147D92] focus:ring-[#147D92] size-4">
                  <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]">Aktifkan Semua</span>
                </label>
              </div>
              <div class="flex flex-col gap-5 pl-[46px] pr-4 max-w-[900px]">
                <div class="flex gap-x-24">
                  <div class="flex flex-col gap-y-6">
                  <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Manajemen Pengguna</span>
                      </div>
                    <button type="button" @click="perms.p1 = !perms.p1" :class="perms.p1 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p1 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Audit Dasar</span>
                      </div>
                    <button type="button" @click="perms.p2 = !perms.p2" :class="perms.p2 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p2 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  </div>
  <div class="flex flex-col gap-y-6">
<div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Pengaturan Sistem</span>
                      </div>
                    <button type="button" @click="perms.p3 = !perms.p3" :class="perms.p3 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p3 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                    </div>
                </div>
              </div>
            </div>
            </div>
            
            <!-- Table Row 2 -->
            <div x-data="{ expanded: false, menuOpen: false, perms: { p1: true, p2: true, p3: true, p4: true }, get allChecked() { return this.perms.p1 && this.perms.p2 && this.perms.p3 && this.perms.p4; }, toggleAll() { let val = !this.allChecked; this.perms.p1 = val; this.perms.p2 = val; this.perms.p3 = val; this.perms.p4 = val; } }" class="flex flex-col border-b border-b-solid border-[#EDF2F5]">
              <div class="h-[70px] flex items-center px-5 shrink-0 hover:bg-[#F9FBFC] transition-colors cursor-pointer" @click="expanded = !expanded">
              <div class="flex items-center grow basis-[0%] min-w-0 gap-[11px]">
                <div class="flex items-center justify-center shrink-0 rounded-[18px] bg-[#E2F4F3] size-9">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#11647A] text-xs/4">
                    NP
                  </div>
                </div>
                <div class="flex flex-col min-w-0 gap-0.5">
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                    Nadia Putri
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                    nadia@verta.co.id
                  </div>
                </div>
              </div>
              <div class="w-[170px] shrink-0">
                <div class="h-6 w-[94px] flex items-center justify-center rounded-md bg-[#E7F6EE]">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#19734A] text-[11px]/4">
                    HR Admin
                  </div>
                </div>
              </div>
              <div class="w-[150px] flex items-center shrink-0">
                <div class="h-6 flex items-center px-[9px] rounded-xl gap-1.5 bg-[#E7F6EE]">
                  <div class="rounded-[3px] shrink-0 bg-[#198754] size-1.5"></div>
                  <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#19734A] text-[11px]/4">
                    Aktif
                  </div>
                </div>
              </div>
              <div class="w-[160px] shrink-0 font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                10 menit lalu
              </div>
              <div class="w-auto flex items-center justify-end gap-2 shrink-0 relative">
                <!-- Dropdown Trigger -->
                <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded hover:bg-gray-200 transition-colors">
                  <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <circle cx="5" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="12" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="19" cy="12" r="1.5" fill="#7890A0" />
                  </svg>
                </button>
                
                <!-- Arrow Expand Button -->
                <button type="button" class="bg-transparent border-none p-1 rounded hover:bg-[#E2F4F3] transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition-transform duration-200 stroke-[#7890A0]" :class="expanded ? 'rotate-90 stroke-[#147D92]' : ''">
                    <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-[40px] top-8 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-10 overflow-hidden flex flex-col py-1">
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit pengguna
                  </button>
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Hapus pengguna
                  </button>
                </div>
              </div>
            </div>
            <!-- Expanded Area -->
            <div x-show="expanded" x-transition.opacity.duration.200ms class="bg-[#F8FAFC] border-t border-t-solid border-[#EDF2F5] px-5 py-6" style="display: none;">
              <div class="flex justify-end w-full mb-6 pr-7">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" @change="toggleAll()" :checked="allChecked" class="rounded-[4px] border-[#DDE6ED] text-[#147D92] focus:ring-[#147D92] size-4">
                  <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]">Aktifkan Semua</span>
                </label>
              </div>
              <div class="flex flex-col gap-5 pl-[46px] pr-4 max-w-[900px]">
                <div class="flex gap-x-24">
  <div class="flex flex-col gap-y-6">
<div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Bank Soal</span>
                      </div>
                    <button type="button" @click="perms.p1 = !perms.p1" :class="perms.p1 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p1 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Sesi Tes & Kandidat</span>
                      </div>
                    <button type="button" @click="perms.p2 = !perms.p2" :class="perms.p2 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p2 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                    </div>
  <div class="flex flex-col gap-y-6">
<div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Paket Tes</span>
                      </div>
                    <button type="button" @click="perms.p3 = !perms.p3" :class="perms.p3 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p3 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Laporan Hasil</span>
                      </div>
                    <button type="button" @click="perms.p4 = !perms.p4" :class="perms.p4 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p4 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  </div>
</div>
              </div>
            </div>
            </div>

            <!-- Table Row 3 -->
            <div x-data="{ expanded: false, menuOpen: false, perms: { p1: true, p2: true }, get allChecked() { return this.perms.p1 && this.perms.p2; }, toggleAll() { let val = !this.allChecked; this.perms.p1 = val; this.perms.p2 = val; } }" class="flex flex-col border-b border-b-solid border-[#EDF2F5]">
              <div class="h-[70px] flex items-center px-5 shrink-0 hover:bg-[#F9FBFC] transition-colors cursor-pointer" @click="expanded = !expanded">
              <div class="flex items-center grow basis-[0%] min-w-0 gap-[11px]">
                <div class="flex items-center justify-center shrink-0 rounded-[18px] bg-[#EFE9FB] size-9">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#11647A] text-xs/4">
                    FA
                  </div>
                </div>
                <div class="flex flex-col min-w-0 gap-0.5">
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                    Faris Akbar
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                    faris@verta.co.id
                  </div>
                </div>
              </div>
              <div class="w-[170px] shrink-0">
                <div class="h-6 w-[94px] flex items-center justify-center rounded-md bg-[#EFE9FB]">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#7257B7] text-[11px]/4">
                    Reviewer
                  </div>
                </div>
              </div>
              <div class="w-[150px] flex items-center shrink-0">
                <div class="h-6 flex items-center px-[9px] rounded-xl gap-1.5 bg-[#E7F6EE]">
                  <div class="rounded-[3px] shrink-0 bg-[#198754] size-1.5"></div>
                  <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#19734A] text-[11px]/4">
                    Aktif
                  </div>
                </div>
              </div>
              <div class="w-[160px] shrink-0 font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                2 jam lalu
              </div>
              <div class="w-auto flex items-center justify-end gap-2 shrink-0 relative">
                <!-- Dropdown Trigger -->
                <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded hover:bg-gray-200 transition-colors">
                  <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <circle cx="5" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="12" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="19" cy="12" r="1.5" fill="#7890A0" />
                  </svg>
                </button>
                
                <!-- Arrow Expand Button -->
                <button type="button" class="bg-transparent border-none p-1 rounded hover:bg-[#E2F4F3] transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition-transform duration-200 stroke-[#7890A0]" :class="expanded ? 'rotate-90 stroke-[#147D92]' : ''">
                    <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-[40px] top-8 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-10 overflow-hidden flex flex-col py-1">
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit pengguna
                  </button>
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Hapus pengguna
                  </button>
                </div>
              </div>
            </div>
            <!-- Expanded Area -->
            <div x-show="expanded" x-transition.opacity.duration.200ms class="bg-[#F8FAFC] border-t border-t-solid border-[#EDF2F5] px-5 py-6" style="display: none;">
              <div class="flex justify-end w-full mb-6 pr-7">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" @change="toggleAll()" :checked="allChecked" class="rounded-[4px] border-[#DDE6ED] text-[#147D92] focus:ring-[#147D92] size-4">
                  <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]">Aktifkan Semua</span>
                </label>
              </div>
              <div class="flex flex-col gap-5 pl-[46px] pr-4 max-w-[900px]">
                <div class="flex gap-x-24">
  <div class="flex flex-col gap-y-6">
<div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Penilaian Essay</span>
                      </div>
                    <button type="button" @click="perms.p1 = !perms.p1" :class="perms.p1 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p1 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                    </div>
  <div class="flex flex-col gap-y-6">
<div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Finalisasi Skor</span>
                      </div>
                    <button type="button" @click="perms.p2 = !perms.p2" :class="perms.p2 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p2 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  </div>
</div>
              </div>
            </div>
            </div>

            <!-- Table Row 4 -->
            <div x-data="{ expanded: false, menuOpen: false, perms: { p1: true, p2: true, p3: true, p4: true }, get allChecked() { return this.perms.p1 && this.perms.p2 && this.perms.p3 && this.perms.p4; }, toggleAll() { let val = !this.allChecked; this.perms.p1 = val; this.perms.p2 = val; this.perms.p3 = val; this.perms.p4 = val; } }" class="flex flex-col border-b border-b-solid border-[#EDF2F5]">
              <div class="h-[70px] flex items-center px-5 shrink-0 hover:bg-[#F9FBFC] transition-colors cursor-pointer" @click="expanded = !expanded">
              <div class="flex items-center grow basis-[0%] min-w-0 gap-[11px]">
                <div class="flex items-center justify-center shrink-0 rounded-[18px] bg-[#FFF3DF] size-9">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#11647A] text-xs/4">
                    MK
                  </div>
                </div>
                <div class="flex flex-col min-w-0 gap-0.5">
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                    Maya Kurnia
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                    maya@verta.co.id
                  </div>
                </div>
              </div>
              <div class="w-[170px] shrink-0">
                <div class="h-6 w-[94px] flex items-center justify-center rounded-md bg-[#E7F6EE]">
                  <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#19734A] text-[11px]/4">
                    HR Admin
                  </div>
                </div>
              </div>
              <div class="w-[150px] flex items-center shrink-0">
                <div class="h-6 flex items-center px-[9px] rounded-xl gap-1.5 bg-[#F0F3F5]">
                  <div class="rounded-[3px] shrink-0 bg-[#7890A0] size-1.5"></div>
                  <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#62798A] text-[11px]/4">
                    Nonaktif
                  </div>
                </div>
              </div>
              <div class="w-[160px] shrink-0 font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                3 hari lalu
              </div>
              <div class="w-auto flex items-center justify-end gap-2 shrink-0 relative">
                <!-- Dropdown Trigger -->
                <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded hover:bg-gray-200 transition-colors">
                  <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <circle cx="5" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="12" cy="12" r="1.5" fill="#7890A0" />
                    <circle cx="19" cy="12" r="1.5" fill="#7890A0" />
                  </svg>
                </button>
                
                <!-- Arrow Expand Button -->
                <button type="button" class="bg-transparent border-none p-1 rounded hover:bg-[#E2F4F3] transition-colors">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition-transform duration-200 stroke-[#7890A0]" :class="expanded ? 'rotate-90 stroke-[#147D92]' : ''">
                    <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-[40px] top-8 w-36 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-10 overflow-hidden flex flex-col py-1">
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Edit pengguna
                  </button>
                  <button type="button" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Hapus pengguna
                  </button>
                </div>
              </div>
            </div>
            <!-- Expanded Area -->
            <div x-show="expanded" x-transition.opacity.duration.200ms class="bg-[#F8FAFC] border-t border-t-solid border-[#EDF2F5] px-5 py-6" style="display: none;">
              <div class="flex justify-end w-full mb-6 pr-7">
                <label class="flex items-center gap-2 cursor-pointer">
                  <input type="checkbox" @change="toggleAll()" :checked="allChecked" class="rounded-[4px] border-[#DDE6ED] text-[#147D92] focus:ring-[#147D92] size-4">
                  <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]">Aktifkan Semua</span>
                </label>
              </div>
              <div class="flex flex-col gap-5 pl-[46px] pr-4 max-w-[900px]">
                <div class="flex gap-x-24">
  <div class="flex flex-col gap-y-6">
<div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Bank Soal</span>
                      </div>
                    <button type="button" @click="perms.p1 = !perms.p1" :class="perms.p1 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p1 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Sesi Tes & Kandidat</span>
                      </div>
                    <button type="button" @click="perms.p2 = !perms.p2" :class="perms.p2 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p2 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                    </div>
  <div class="flex flex-col gap-y-6">
<div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Paket Tes</span>
                      </div>
                    <button type="button" @click="perms.p3 = !perms.p3" :class="perms.p3 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p3 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                      <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]">Laporan Hasil</span>
                      </div>
                    <button type="button" @click="perms.p4 = !perms.p4" :class="perms.p4 ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                      <span aria-hidden="true" :class="perms.p4 ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                  </div>
                  </div>
</div>
              </div>
            </div>
            </div>
            </div>
            <!-- Table Footer -->
            <div class="flex items-center justify-between p-5 border-t border-t-solid border-[#EDF2F5]">
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                Menampilkan 1-4 dari 16 pengguna
              </div>
              <div class="flex items-center gap-2.5">
                <button class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                  Sebelumnya
                </button>
                
                <div class="flex items-center gap-1 mx-1">
                  <button class="size-8 rounded-[6px] bg-[#147D92] text-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center">1</button>
                  <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">2</button>
                  <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">3</button>
                  <span class="text-[#62798A] px-1">...</span>
                  <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">10</button>
                </div>

                <button class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors">
                  Selanjutnya
                </button>
              </div>
            </div>
          </div>
          
        </div>
        </div>
@endsection

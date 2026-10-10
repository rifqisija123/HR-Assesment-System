@extends('layouts.superadmin')
@section('title', 'Manajemen Pengguna')
@section('page_title', 'Manajemen pengguna')

@section('content')
        <!-- Content Area -->
        <div x-data="userTable()" x-init="init()" class="flex flex-col grow basis-[0%] min-w-0 pt-[38px] pb-10 gap-6 px-10 bg-[#F7F9FC]">

          <!-- Toast Notification -->
          <div x-show="toast.show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;"
              class="fixed top-6 right-6 z-50 max-w-[420px] flex items-start gap-3 px-4 py-3.5 rounded-[12px] shadow-[0_10px_30px_rgba(16,42,67,0.12)] border border-solid"
              :class="toast.type === 'success' ? 'bg-[#E7F6EE] border-[#BFE5CF]' : 'bg-[#FFF7E6] border-[#F5D9A8]'">
            <svg x-show="toast.type === 'success'" width="18" height="18" viewBox="0 0 24 24" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10" fill="#198754"/><path d="m8 12 3 3 5-6" fill="none" stroke="#fff" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
            <svg x-show="toast.type !== 'success'" width="18" height="18" viewBox="0 0 24 24" class="shrink-0 mt-0.5"><circle cx="12" cy="12" r="10" fill="#D69E2E"/><path d="M12 7v6M12 17h.01" stroke="#fff" stroke-width="2.4" stroke-linecap="round"/></svg>
            <div class="font-['Inter',system-ui,sans-serif] text-[13px]/5 font-medium" :class="toast.type === 'success' ? 'text-[#19734A]' : 'text-[#8A5A00]'" x-text="toast.message"></div>
            <button type="button" @click="toast.show = false" class="ml-1 bg-transparent border-none cursor-pointer p-0.5 text-[#7890A0] hover:text-[#314E60]" aria-label="Tutup">
              <svg width="14" height="14" viewBox="0 0 24 24"><path d="M18 6 6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
          </div>

          <div class="flex items-end justify-between gap-6">
            <div class="flex flex-col gap-2">
              <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
                AKSES &amp; PERAN
              </div>
              <h1 class="m-0 tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
                Manajemen pengguna
              </h1>
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
                Buat akses, atur peran, dan kelola status akun administratif.
              </div>
            </div>
            <a href="{{ url('/usermanagement/add') }}" id="btn-add-user" class="h-[42px] flex items-center shrink-0 px-4 rounded-[10px] gap-[9px] bg-[#147D92] cursor-pointer hover:bg-[#116a7c] transition-colors border-none no-underline">
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
                <input id="user-search" type="text" x-model="filters.search" @input.debounce.400ms="fetchUsers(1)" placeholder="Cari nama atau email..." class="font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 bg-transparent border-none outline-none w-full placeholder:text-[#92A4B0]" />
              </div>
              <div class="flex gap-2.5">
                <div class="relative">
                  <select id="filter-role" x-model="filters.role" @change="fetchUsers(1)" class="appearance-none h-10 w-full pl-3 pr-10 rounded-[10px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/4.5 outline-none focus:border-[#147D92]">
                    <option value="">Semua role</option>
                    <option value="super_admin">Super Admin</option>
                    <option value="hr_admin">HR Admin</option>
                    <option value="reviewer">Reviewer</option>
                  </select>
                  <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
                <div class="relative">
                  <select id="filter-status" x-model="filters.status" @change="fetchUsers(1)" class="appearance-none h-10 w-full pl-3 pr-10 rounded-[10px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]/4.5 outline-none focus:border-[#147D92]">
                    <option value="">Semua status</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
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
              <div class="w-[62px] shrink-0"></div>
            </div>

            <div class="flex flex-col max-h-[500px] overflow-y-auto overflow-x-hidden styled-scrollbar relative">

              <!-- Loading Skeleton -->
              <template x-if="loading && users.length === 0">
                <div class="flex flex-col">
                  <template x-for="i in 4" :key="'sk' + i">
                    <div class="h-[70px] flex items-center px-5 gap-[11px] border-b border-b-solid border-[#EDF2F5] animate-pulse">
                      <div class="size-9 rounded-[18px] bg-[#EDF2F5]"></div>
                      <div class="flex flex-col gap-2 grow">
                        <div class="h-3 w-40 rounded bg-[#EDF2F5]"></div>
                        <div class="h-2.5 w-56 rounded bg-[#F3F7F9]"></div>
                      </div>
                    </div>
                  </template>
                </div>
              </template>

              <!-- Error State -->
              <div x-show="error && !loading" style="display: none;" class="flex flex-col items-center justify-center gap-3 py-14">
                <div class="font-['Inter',system-ui,sans-serif] text-[#C53030] text-[13px]" x-text="error"></div>
                <button type="button" @click="fetchUsers(meta.current_page)" class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#486174] hover:bg-[#F8FAFC] cursor-pointer">Coba lagi</button>
              </div>

              <!-- Empty State -->
              <div x-show="!loading && !error && users.length === 0" style="display: none;" class="flex flex-col items-center justify-center gap-2 py-14">
                <div class="flex items-center justify-center size-12 rounded-[14px] bg-[#E2F4F3] mb-1">
                  <svg width="22" height="22" viewBox="0 0 24 24"><circle cx="9" cy="8" r="4" fill="none" stroke="#147D92" stroke-width="2"/><path d="M2 21v-1a6 6 0 0 1 6-6h2a6 6 0 0 1 6 6v1" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#314E60] text-[14px]">Belum ada pengguna</div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[13px]">Tidak ada data yang cocok dengan filter saat ini.</div>
              </div>

              <!-- Table Rows -->
              <template x-for="user in users" :key="user.id">
                <div x-data="userRow(user)" class="flex flex-col border-b border-b-solid border-[#EDF2F5]" :class="loading ? 'opacity-60' : ''">
                  <div class="h-[70px] flex items-center px-5 shrink-0 transition-colors" :class="isProtected ? '' : 'hover:bg-[#F9FBFC] cursor-pointer'" @click="if (!isProtected) expanded = !expanded">
                    <div class="flex items-center grow basis-[0%] min-w-0 gap-[11px]">
                      <div class="flex items-center justify-center shrink-0 rounded-[18px] size-9" :class="roleStyle(user.role).avatar">
                        <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#11647A] text-xs/4" x-text="user.initials"></div>
                      </div>
                      <div class="flex flex-col min-w-0 gap-0.5">
                        <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5 truncate" x-text="user.name"></div>
                        <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4 truncate" x-text="user.email"></div>
                      </div>
                    </div>
                    <div class="w-[170px] shrink-0">
                      <div class="h-6 w-[94px] flex items-center justify-center rounded-md" :class="roleStyle(user.role).badge">
                        <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[11px]/4" :class="roleStyle(user.role).text" x-text="user.role_label"></div>
                      </div>
                    </div>
                    <div class="w-[150px] flex items-center shrink-0">
                      <div class="h-6 flex items-center px-[9px] rounded-xl gap-1.5" :class="user.is_active ? 'bg-[#E7F6EE]' : 'bg-[#F0F3F5]'">
                        <div class="rounded-[3px] shrink-0 size-1.5" :class="user.is_active ? 'bg-[#198754]' : 'bg-[#7890A0]'"></div>
                        <div class="font-['Inter',system-ui,sans-serif] font-bold text-[11px]/4" :class="user.is_active ? 'text-[#19734A]' : 'text-[#62798A]'" x-text="user.status_label"></div>
                      </div>
                    </div>
                    <div class="w-[160px] shrink-0 font-['Inter',system-ui,sans-serif] text-[13px]/4.5" :class="user.invite_pending && !user.last_login_at ? 'text-[#B7791F]' : 'text-[#62798A]'" x-text="user.last_activity"></div>
                    <div class="w-auto flex items-center justify-end gap-2 shrink-0 relative">
                      <template x-if="!isProtected">
                        <div class="flex items-center gap-2 relative">
                          <!-- Dropdown Trigger -->
                          <button type="button" @click.stop="menuOpen = !menuOpen" @click.outside="menuOpen = false" class="bg-transparent border-none cursor-pointer p-1 rounded hover:bg-gray-200 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                              <circle cx="5" cy="12" r="1.5" fill="#7890A0" />
                              <circle cx="12" cy="12" r="1.5" fill="#7890A0" />
                              <circle cx="19" cy="12" r="1.5" fill="#7890A0" />
                            </svg>
                          </button>

                          <!-- Arrow Expand Button -->
                          <button type="button" @click.stop="expanded = !expanded" class="bg-transparent border-none p-1 rounded hover:bg-[#E2F4F3] transition-colors cursor-pointer">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="transition-transform duration-200 stroke-[#7890A0]" :class="expanded ? 'rotate-90 stroke-[#147D92]' : ''">
                              <path d="M9 18l6-6-6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                          </button>

                          <!-- Dropdown Menu -->
                          <div x-show="menuOpen" x-transition.opacity.duration.200ms style="display: none;" class="absolute right-[40px] top-8 w-40 bg-white rounded-[8px] shadow-[0_4px_12px_rgba(0,0,0,0.1)] border border-solid border-[#EDF2F5] z-10 overflow-hidden flex flex-col py-1">
                            <a :href="'{{ url('/usermanagement/edit') }}/' + user.id" @click.stop="menuOpen = false" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] hover:bg-[#F8FAFC] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2 no-underline">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" stroke="#314E60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                              Edit pengguna
                            </a>
                            <button type="button" @click.stop="menuOpen = false; $dispatch('confirm-delete-user', user)" class="w-full text-left px-4 py-2 font-['Inter',system-ui,sans-serif] text-[13px] text-[#E53E3E] hover:bg-[#FEF2F2] transition-colors border-none bg-transparent cursor-pointer flex items-center gap-2">
                              <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 6h18" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke="#E53E3E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                              </svg>
                              Hapus pengguna
                            </button>
                          </div>
                        </div>
                      </template>
                    </div>
                  </div>

                  <!-- Expanded Area (hak akses berdasarkan role) -->
                  <template x-if="!isProtected">
                    <div x-show="expanded" x-transition.opacity.duration.200ms class="bg-[#F8FAFC] border-t border-t-solid border-[#EDF2F5] px-5 py-6" style="display: none;">
                      <div class="flex justify-end w-full mb-6 pr-7">
                        <label class="flex items-center gap-2 cursor-pointer">
                          <input type="checkbox" @change="toggleAll()" :checked="allChecked" class="rounded-[4px] border-[#DDE6ED] text-[#147D92] focus:ring-[#147D92] size-4">
                          <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#486174] text-[13px]">Aktifkan Semua</span>
                        </label>
                      </div>
                      <div class="flex flex-col gap-5 pl-[46px] pr-4 max-w-[900px]">
                        <div class="flex gap-x-24">
                          <template x-for="col in columns" :key="col.key">
                            <div class="flex flex-col gap-y-6">
                              <template x-for="perm in col.items" :key="perm.key">
                                <div class="flex items-center justify-between gap-4 min-w-[200px]">
                                  <div class="flex flex-col">
                                    <span class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-[13px]" x-text="perm.label"></span>
                                  </div>
                                  <button type="button" @click="perms[perm.key] = !perms[perm.key]" :class="perms[perm.key] ? 'bg-[#147D92]' : 'bg-[#DDE6ED]'" class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none">
                                    <span aria-hidden="true" :class="perms[perm.key] ? 'translate-x-4' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                                  </button>
                                </div>
                              </template>
                            </div>
                          </template>
                        </div>
                      </div>
                    </div>
                  </template>
                </div>
              </template>
            </div>

            <!-- Table Footer -->
            <div class="flex items-center justify-between p-5 border-t border-t-solid border-[#EDF2F5]">
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                <span x-show="meta.total > 0">Menampilkan <span x-text="meta.from"></span>-<span x-text="meta.to"></span> dari <span x-text="meta.total"></span> pengguna</span>
                <span x-show="meta.total === 0">Tidak ada pengguna</span>
              </div>
              <div class="flex items-center gap-2.5">
                <button id="btn-prev-page" type="button" @click="fetchUsers(meta.current_page - 1)" :disabled="meta.current_page <= 1 || loading" class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors cursor-pointer disabled:text-[#62798A] disabled:opacity-50 disabled:cursor-not-allowed">
                  Sebelumnya
                </button>

                <div class="flex items-center gap-1 mx-1">
                  <template x-for="(p, idx) in pages" :key="'p' + idx">
                    <div>
                      <span x-show="p === '...'" class="text-[#62798A] px-1">...</span>
                      <button x-show="p !== '...'" type="button" @click="fetchUsers(p)" :class="p === meta.current_page ? 'bg-[#147D92] text-white' : 'bg-transparent text-[#62798A] hover:bg-[#F8FAFC]'" class="size-8 rounded-[6px] border-none cursor-pointer text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors" x-text="p"></button>
                    </div>
                  </template>
                </div>

                <button id="btn-next-page" type="button" @click="fetchUsers(meta.current_page + 1)" :disabled="meta.current_page >= meta.last_page || loading" class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors cursor-pointer disabled:text-[#62798A] disabled:opacity-50 disabled:cursor-not-allowed">
                  Selanjutnya
                </button>
              </div>
            </div>
          </div>

        </div>
@endsection

@push('scripts')
<script>
  // Hak akses default per role (UI)
  const ROLE_PERMISSIONS = {
    super_admin: [
      [{ key: 'user_mgmt', label: 'Manajemen Pengguna' }, { key: 'audit', label: 'Audit Dasar' }],
      [{ key: 'settings', label: 'Pengaturan Sistem' }],
    ],
    hr_admin: [
      [{ key: 'bank', label: 'Bank Soal' }, { key: 'session', label: 'Sesi Tes & Kandidat' }],
      [{ key: 'package', label: 'Paket Tes' }, { key: 'report', label: 'Laporan Hasil' }],
    ],
    reviewer: [
      [{ key: 'essay', label: 'Penilaian Essay' }],
      [{ key: 'score', label: 'Finalisasi Skor' }],
    ],
  };

  const ROLE_STYLES = {
    super_admin: { avatar: 'bg-[#D7EEF3]', badge: 'bg-[#E7EEF9]', text: 'text-[#3B5B93]' },
    hr_admin:    { avatar: 'bg-[#E2F4F3]', badge: 'bg-[#E7F6EE]', text: 'text-[#19734A]' },
    reviewer:    { avatar: 'bg-[#EFE9FB]', badge: 'bg-[#EFE9FB]', text: 'text-[#7257B7]' },
  };

  function userRow(user) {
    const isProtected = Boolean(user.email && user.email.toLowerCase() === 'superadmin@sii.com');
    const groups = ROLE_PERMISSIONS[user.role] || [];
    const perms = {};
    groups.flat().forEach(p => perms[p.key] = true);

    return {
      isProtected,
      expanded: false,
      menuOpen: false,
      perms,
      columns: groups.map((items, i) => ({ key: 'c' + i, items })),
      get allChecked() { return Object.values(this.perms).every(Boolean); },
      toggleAll() {
        const val = !this.allChecked;
        Object.keys(this.perms).forEach(k => this.perms[k] = val);
      },
    };
  }

  function userTable() {
    return {
      users: [],
      loading: false,
      error: '',
      filters: { search: '', role: '', status: '' },
      meta: { current_page: 1, last_page: 1, from: 0, to: 0, total: 0, per_page: 10 },
      toast: { show: false, type: 'success', message: '' },

      init() {
        window.addEventListener('confirm-delete-user', (e) => this.deleteUser(e.detail));

        // Tampilkan notifikasi dari halaman tambah/edit pengguna
        const flash = sessionStorage.getItem('userFlash');
        if (flash) {
          sessionStorage.removeItem('userFlash');
          try { this.showToast(JSON.parse(flash)); } catch (e) {}
        }
        this.fetchUsers(1);
      },

      async deleteUser(user) {
        if (!confirm(`Apakah Anda yakin ingin menghapus pengguna "${user.name}"?`)) return;

        try {
          const res = await fetch(`{{ url('/api/users') }}/${user.id}`, {
            method: 'DELETE',
            credentials: 'same-origin',
            headers: {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
          });
          const data = await res.json().catch(() => ({}));

          if (!res.ok) {
            this.showToast({ type: 'error', message: data.message || 'Gagal menghapus pengguna.' });
            return;
          }

          this.showToast({ type: 'success', message: data.message || 'Pengguna berhasil dihapus.' });
          this.fetchUsers(this.meta.current_page);
        } catch (e) {
          this.showToast({ type: 'error', message: 'Tidak dapat terhubung ke server.' });
        }
      },

      roleStyle(role) {
        return ROLE_STYLES[role] || ROLE_STYLES.hr_admin;
      },

      showToast({ type = 'success', message = '' }) {
        this.toast = { show: true, type, message };
        setTimeout(() => this.toast.show = false, 6000);
      },

      get pages() {
        const { current_page: c, last_page: l } = this.meta;
        if (l <= 7) return Array.from({ length: l }, (_, i) => i + 1);
        const out = [1];
        const start = Math.max(2, c - 1), end = Math.min(l - 1, c + 1);
        if (start > 2) out.push('...');
        for (let i = start; i <= end; i++) out.push(i);
        if (end < l - 1) out.push('...');
        out.push(l);
        return out;
      },

      async fetchUsers(page = 1) {
        if (page < 1 || (this.meta.last_page && page > this.meta.last_page && page !== 1)) return;
        this.loading = true;
        this.error = '';

        const params = new URLSearchParams({ page, per_page: this.meta.per_page });
        Object.entries(this.filters).forEach(([k, v]) => { if (v) params.append(k, v); });

        try {
          const res = await fetch(`{{ url('/api/users') }}?${params}`, {
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
          });
          if (res.status === 401) { window.location.href = '{{ route('login') }}'; return; }
          const data = await res.json();
          if (!res.ok) throw new Error(data.message || 'Gagal memuat data pengguna.');

          this.users = data.data;
          this.meta = {
            current_page: data.current_page,
            last_page: data.last_page,
            from: data.from || 0,
            to: data.to || 0,
            total: data.total,
            per_page: data.per_page,
          };
        } catch (e) {
          this.error = e.message || 'Gagal memuat data pengguna.';
        } finally {
          this.loading = false;
        }
      },
    };
  }
</script>
@endpush

@extends('layouts.superadmin')
@section('title', 'Pengaturan Sistem')
@section('page_title', 'Pengaturan sistem')

@section('content')
        <!-- Content Area -->
        <div class="flex flex-col grow basis-[0%] min-w-0 min-h-0 pt-[38px] pb-10 gap-6 px-10 bg-[#F7F9FC]">
          
          <div class="flex flex-col gap-2">
            <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
              KONFIGURASI
            </div>
            <div class="tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
              Pengaturan sistem
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
              Kelola identitas perusahaan, notifikasi email, keamanan, dan backup.
            </div>
          </div>
          
          <div class="flex grow basis-[0%] min-h-0 gap-5">
            
            <!-- Side Nav Settings -->
            <div class="w-56 flex flex-col self-start shrink-0 p-2.5 rounded-[14px] gap-1 bg-white border border-solid border-[#DDE6ED]">
              <div id="nav-profil" onclick="switchTab('profil')" class="nav-tab h-10 flex items-center px-2.5 rounded-[9px] gap-2.5 shrink-0 bg-[#E2F4F3] text-[#147D92] cursor-pointer transition-colors">
                <div class="w-[18px] h-[18px] flex items-center justify-center shrink-0">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <path d="M3 21h18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 21V5l6-3 6 3v16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9 9h.01" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M15 9h.01" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9 13h.01" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M15 13h.01" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[13px]/4.5">
                  Profil perusahaan
                </div>
              </div>
              <div id="nav-email" onclick="switchTab('email')" class="nav-tab h-10 flex items-center px-2.5 rounded-[9px] gap-2.5 shrink-0 text-[#62798A] cursor-pointer hover:bg-gray-50 transition-colors">
                <div class="w-[18px] h-[18px] flex items-center justify-center shrink-0">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <rect x="3" y="5" width="18" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="m3 7 9 6 9-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] font-medium text-[13px]/4.5">
                  Konfigurasi email
                </div>
              </div>
              <div id="nav-keamanan" onclick="switchTab('keamanan')" class="nav-tab h-10 flex items-center px-2.5 rounded-[9px] gap-2.5 shrink-0 text-[#62798A] cursor-pointer hover:bg-gray-50 transition-colors">
                <div class="w-[18px] h-[18px] flex items-center justify-center shrink-0">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="m9 12 2 2 4-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] font-medium text-[13px]/4.5">
                  Keamanan & akses
                </div>
              </div>
              <div id="nav-backup" onclick="switchTab('backup')" class="nav-tab h-10 flex items-center px-2.5 rounded-[9px] gap-2.5 shrink-0 text-[#62798A] cursor-pointer hover:bg-gray-50 transition-colors">
                <div class="w-[18px] h-[18px] flex items-center justify-center shrink-0">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <ellipse cx="12" cy="5" rx="8" ry="3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 5v7c0 1.66 3.58 3 8 3s8-1.34 8-3V5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 12v7c0 1.66 3.58 3 8 3s8-1.34 8-3v-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] font-medium text-[13px]/4.5">
                  Konfigurasi backup
                </div>
              </div>
            </div>
            
            <!-- Main Card Content -->
            <div id="tab-profil" class="tab-content flex flex-col grow min-h-0 rounded-[14px] overflow-hidden bg-white border border-solid border-[#DDE6ED]">
              
              <div class="flex flex-col pt-[22px] pb-[18px] gap-[5px] px-6 border-b border-b-solid border-b-[#EDF2F5]">
                <div class="tracking-[-0.015em] font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-lg/6">
                  Profil perusahaan
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.75">
                  Informasi ini digunakan pada undangan kandidat dan laporan asesmen.
                </div>
              </div>
              
              <div class="flex flex-col py-5 px-6 gap-[18px] grow overflow-y-auto min-h-0">
                
                <div class="h-[76px] flex items-center py-3 px-[14px] rounded-[11px] gap-[14px] shrink-0 bg-[#FAFCFD] border border-dashed border-[#B5C8D4]">
                  <div class="w-[50px] h-[50px] flex items-center justify-center shrink-0 rounded-[13px] bg-[#147D92]">
                    <div class="flex font-['Inter',system-ui,sans-serif] font-extrabold text-white text-[21px]/6.5">
                      V
                    </div>
                  </div>
                  <div class="flex flex-col grow basis-[0%] gap-1">
                    <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                      Logo perusahaan
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                      PNG, JPG, atau SVG · Maks. 2 MB
                    </div>
                  </div>
                  <button class="h-[34px] flex items-center shrink-0 px-[11px] rounded-lg bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors">
                    <div class="flex font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Unggah logo
                    </div>
                  </button>
                </div>
                
                <div class="flex gap-4">
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Nama perusahaan
                    </label>
                    <input type="text" value="Verta Indonesia" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                  </div>
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Email perusahaan
                    </label>
                    <input type="email" value="hello@verta.co.id" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                  </div>
                </div>
                
                <div class="flex gap-4">
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Nomor telepon
                    </label>
                    <input type="text" value="+62 21 555 0188" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                  </div>
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Zona waktu
                    </label>
                    <div class="relative h-10 w-full shrink-0">
                      <select class="appearance-none h-10 w-full pl-3 pr-10 rounded-[9px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92]">
                        <option value="Asia/Jakarta">(GMT+07:00) Asia/Jakarta</option>
                      </select>
                      <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                        <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </div>
                  </div>
                </div>
                
                <div class="flex flex-col gap-[7px]">
                  <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                    Alamat
                  </label>
                  <input type="text" value="Jl. Jenderal Sudirman No. 45, Jakarta Selatan" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                </div>
                
                <div class="flex flex-col gap-[7px]">
                  <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                    Situs web
                  </label>
                  <div class="h-10 flex items-center px-3 rounded-[9px] gap-[9px] shrink-0 border border-solid border-[#DDE6ED] focus-within:border-[#147D92] transition-colors overflow-hidden bg-white">
                    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                      <circle cx="12" cy="12" r="9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M3 12h18" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M12 3a14 14 0 0 1 0 18" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M12 3a14 14 0 0 0 0 18" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <input type="url" value="https://verta.co.id" class="font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 bg-transparent border-none outline-none w-full" />
                  </div>
                </div>
                
              </div>
              
              <div class="h-[68px] flex items-center justify-end px-6 shrink-0 border-t border-t-solid border-t-[#EDF2F5]">
                <button class="h-10 flex items-center px-3.5 rounded-[9px] gap-2 bg-[#147D92] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
                  <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <path d="M20 6 9 17l-5-5" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-[13px]/4.5">
                    Simpan perubahan
                  </div>
                </button>
              </div>
              
            </div>
            
            <!-- Tab Konfigurasi Email -->
            <div id="tab-email" class="tab-content hidden flex-col grow min-h-0 rounded-[14px] overflow-hidden bg-white border border-solid border-[#DDE6ED]">
              <div class="flex flex-col pt-[22px] pb-[18px] gap-[5px] px-6 border-b border-b-solid border-b-[#EDF2F5]">
                <div class="tracking-[-0.015em] font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-lg/6">
                  Konfigurasi email
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.75">
                  Pengaturan identitas pengirim email notifikasi dan undangan kandidat.
                </div>
              </div>
              <div class="flex flex-col py-5 px-6 gap-[18px] grow overflow-y-auto min-h-0">
                <div class="flex flex-col gap-[7px]">
                  <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                    Nama Pengirim Global (Global From Name)
                  </label>
                  <input type="text" value="Tim Rekrutmen Verta" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                </div>
                <div class="flex items-center gap-3 mt-2">
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#147D92]"></div>
                  </label>
                  <div class="flex flex-col">
                    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#314E60] text-[13px]/4.5">
                      Sertakan Nama HR secara Dinamis
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                      Sistem akan otomatis menambahkan nama HR yang sedang login (contoh: "Rizky (Tim Rekrutmen Verta)").
                    </div>
                  </div>
                </div>
              </div>
              <div class="h-[68px] flex items-center justify-between px-6 shrink-0 border-t border-t-solid border-t-[#EDF2F5]">
                <button class="h-10 flex items-center px-4 rounded-[9px] bg-white border border-solid border-[#DDE6ED] text-[#486174] font-['Inter',system-ui,sans-serif] font-[650] text-[13px]/4.5 cursor-pointer hover:bg-gray-50 transition-colors">
                  Uji Koneksi Email
                </button>
                <button class="h-10 flex items-center px-3.5 rounded-[9px] gap-2 bg-[#147D92] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
                  <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <path d="M20 6 9 17l-5-5" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-[13px]/4.5">
                    Simpan perubahan
                  </div>
                </button>
              </div>
            </div>

            <!-- Tab Keamanan & Akses -->
            <div id="tab-keamanan" class="tab-content hidden flex-col grow min-h-0 rounded-[14px] overflow-hidden bg-white border border-solid border-[#DDE6ED]">
              <div class="flex flex-col pt-[22px] pb-[18px] gap-[5px] px-6 border-b border-b-solid border-b-[#EDF2F5]">
                <div class="tracking-[-0.015em] font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-lg/6">
                  Keamanan & akses
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.75">
                  Kelola kebijakan kata sandi dan pembatasan akses sesi admin.
                </div>
              </div>
              <div class="flex flex-col py-5 px-6 gap-[18px] grow overflow-y-auto min-h-0">
                <div class="flex gap-4">
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Durasi kedaluwarsa sesi (menit)
                    </label>
                    <input type="number" value="120" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                  </div>
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Batas maksimal percobaan login
                    </label>
                    <input type="number" value="5" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                  </div>
                </div>
                <div class="flex items-center gap-3 mt-2">
                  <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer" checked>
                    <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#147D92]"></div>
                  </label>
                  <div class="flex flex-col">
                    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#314E60] text-[13px]/4.5">
                      Wajibkan kata sandi kuat
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                      Akun baru harus menggunakan kombinasi huruf besar, angka, dan karakter spesial.
                    </div>
                  </div>
                </div>
              </div>
              <div class="h-[68px] flex items-center justify-end px-6 shrink-0 border-t border-t-solid border-t-[#EDF2F5]">
                <button class="h-10 flex items-center px-3.5 rounded-[9px] gap-2 bg-[#147D92] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
                  <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <path d="M20 6 9 17l-5-5" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-[13px]/4.5">
                    Simpan perubahan
                  </div>
                </button>
              </div>
            </div>

            <!-- Tab Konfigurasi Backup -->
            <div id="tab-backup" class="tab-content hidden flex-col grow min-h-0 rounded-[14px] overflow-hidden bg-white border border-solid border-[#DDE6ED]">
              <div class="flex flex-col pt-[22px] pb-[18px] gap-[5px] px-6 border-b border-b-solid border-b-[#EDF2F5]">
                <div class="tracking-[-0.015em] font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-lg/6">
                  Konfigurasi backup
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.75">
                  Atur jadwal pencadangan otomatis untuk melindungi data dari kehilangan permanen.
                </div>
              </div>
              <div class="flex flex-col py-5 px-6 gap-[18px] grow overflow-y-auto min-h-0">
                <div class="flex gap-4">
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Frekuensi backup otomatis
                    </label>
                    <div class="relative h-10 w-full shrink-0">
                      <select class="appearance-none h-10 w-full pl-3 pr-10 rounded-[9px] border border-solid border-[#DDE6ED] bg-white cursor-pointer hover:bg-gray-50 transition-colors font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92]">
                        <option value="daily">Harian</option>
                        <option value="weekly">Mingguan</option>
                        <option value="monthly">Bulanan</option>
                        <option value="never">Jangan otomatis</option>
                      </select>
                      <svg class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                        <polyline points="6 9 12 15 18 9" fill="none" stroke="#7890A0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </div>
                  </div>
                  <div class="flex flex-col grow basis-[0%] gap-[7px]">
                    <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                      Waktu pelaksanaan backup
                    </label>
                    <input type="time" value="02:00" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                  </div>
                </div>
                <div class="flex flex-col gap-[7px]">
                  <label class="font-['Inter',system-ui,sans-serif] font-semibold text-[#486174] text-xs/4">
                    Retensi data backup (Hari)
                  </label>
                  <input type="number" value="30" class="h-10 flex items-center px-3 rounded-[9px] shrink-0 border border-solid border-[#DDE6ED] font-['Inter',system-ui,sans-serif] text-[#314E60] text-[13px]/4.5 outline-none focus:border-[#147D92] w-full" />
                  <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4 mt-1">
                    Backup yang lebih lama dari rentang hari ini akan otomatis dihapus untuk menghemat ruang penyimpanan.
                  </div>
                </div>
              </div>
              <div class="h-[68px] flex items-center justify-between px-6 shrink-0 border-t border-t-solid border-t-[#EDF2F5]">
                <button class="h-10 flex items-center px-4 rounded-[9px] bg-white border border-solid border-[#DDE6ED] text-[#486174] font-['Inter',system-ui,sans-serif] font-[650] text-[13px]/4.5 cursor-pointer hover:bg-gray-50 transition-colors">
                  Backup Sekarang
                </button>
                <button class="h-10 flex items-center px-3.5 rounded-[9px] gap-2 bg-[#147D92] border-none cursor-pointer hover:bg-[#116a7c] transition-colors">
                  <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0">
                    <path d="M20 6 9 17l-5-5" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-[13px]/4.5">
                    Simpan Aturan
                  </div>
                </button>
              </div>
            </div>
          </div>
          
        </div>
<script>
  function switchTab(tabId) {
    // Sembunyikan semua konten tab
    document.querySelectorAll('.tab-content').forEach(el => {
      el.classList.add('hidden');
      el.classList.remove('flex');
    });
    // Tampilkan tab yang dipilih
    const activeTab = document.getElementById('tab-' + tabId);
    if (activeTab) {
      activeTab.classList.remove('hidden');
      activeTab.classList.add('flex');
    }
    
    // Reset gaya semua menu navigasi tab (kembali ke abu-abu inactive)
    document.querySelectorAll('.nav-tab').forEach(el => {
      el.classList.remove('bg-[#E2F4F3]', 'text-[#147D92]');
      el.classList.add('text-[#62798A]', 'hover:bg-gray-50');
    });
    // Tambahkan gaya aktif (biru/hijau tosca) pada menu yang diklik
    const activeNav = document.getElementById('nav-' + tabId);
    if (activeNav) {
      activeNav.classList.remove('text-[#62798A]', 'hover:bg-gray-50');
      activeNav.classList.add('bg-[#E2F4F3]', 'text-[#147D92]');
    }
  }
</script>
@endsection

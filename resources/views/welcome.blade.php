<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verta Assess - Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="antialiased">
    <div class="[font-synthesis:none] flex overflow-clip w-full min-h-screen bg-[#F7F9FC]">
      <div class="flex flex-col pt-7 pb-5 min-h-screen w-[252px] shrink-0 px-4.5 bg-[#102A43]">
        <div class="flex items-center pb-7 gap-3 px-2 border-b border-b-solid border-b-[#DDE6ED2E]">
          <div class="w-9.5 h-9.5 flex items-center justify-center rounded-[11px] shrink-0 bg-[#147D92]">
            <div class="flex font-['Inter',system-ui,sans-serif] font-extrabold text-white text-[19px]/6">
              V
            </div>
          </div>
          <div class="flex flex-col gap-0.5">
            <div class="tracking-[-0.02em] font-['Inter',system-ui,sans-serif] font-bold text-white text-base/5">
              Verta Assess
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#AFC2D0] text-xs/4">
              Control center
            </div>
          </div>
        </div>
        <div class="flex flex-col pt-6.5 gap-1.5">
          <div class="pb-1.25 px-2.5">
            <div class="tracking-widest font-['Inter',system-ui,sans-serif] font-bold text-[#89A1B3] text-[11px]/4">
              ADMINISTRASI
            </div>
          </div>
          <div class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0 bg-[#1D4C63]">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <rect x="3" y="3" width="7" height="7" rx="1" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <rect x="14" y="3" width="7" height="7" rx="1" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <rect x="3" y="14" width="7" height="7" rx="1" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <rect x="14" y="14" width="7" height="7" rx="1" fill="none" stroke="#75D5D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] font-semibold text-white text-sm/5">
              Ringkasan
            </div>
          </div>
          <div class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="#B7C8D5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <circle cx="9" cy="7" r="4" fill="none" stroke="#B7C8D5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M22 21v-2a4 4 0 0 0-3-3.87" fill="none" stroke="#B7C8D5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M16 3.13a4 4 0 0 1 0 7.75" fill="none" stroke="#B7C8D5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#B7C8D5] text-sm/5">
              Manajemen pengguna
            </div>
          </div>
          <div class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <circle cx="12" cy="12" r="3" fill="none" stroke="#B7C8D5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06-2 2-.06-.06A1.65 1.65 0 0 0 16 18.4a1.65 1.65 0 0 0-1 1.51V20h-3v-.09A1.65 1.65 0 0 0 11 18.4a1.65 1.65 0 0 0-1.82.33l-.06.06-2-2 .06-.06A1.65 1.65 0 0 0 7.6 15a1.65 1.65 0 0 0-1.51-1H6v-3h.09A1.65 1.65 0 0 0 7.6 10a1.65 1.65 0 0 0-.33-1.82l-.06-.06 2-2 .06.06A1.65 1.65 0 0 0 11 5.6h.01A1.65 1.65 0 0 0 12 4.09V4h3v.09A1.65 1.65 0 0 0 16 5.6h.01a1.65 1.65 0 0 0 1.82-.33l.06-.06 2 2-.06.06A1.65 1.65 0 0 0 19.4 9v.01A1.65 1.65 0 0 0 20.91 10H21v3h-.09A1.65 1.65 0 0 0 19.4 14Z" fill="none" stroke="#B7C8D5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#B7C8D5] text-sm/5">
              Pengaturan sistem
            </div>
          </div>
          <div class="h-10.5 flex items-center px-3 rounded-[10px] gap-3 shrink-0">
            <div class="w-4.5 h-4.5 flex items-center justify-center shrink-0">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" fill="none" stroke="#B7C8D5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#B7C8D5] text-sm/5">
              Riwayat aktivitas
            </div>
          </div>
        </div>
        <div class="grow basis-[0%]"></div>
        <div class="flex items-center pt-4.5 gap-2.5 px-2 border-t border-t-solid border-t-[#DDE6ED2E]">
          <div class="flex items-center justify-center shrink-0 rounded-[18px] bg-[#D1F0ED] size-9">
            <div class="flex font-['Inter',system-ui,sans-serif] font-bold text-[#125A6B] text-[13px]/4.5">
              RM
            </div>
          </div>
          <div class="flex flex-col grow basis-[0%] gap-0.5">
            <div class="font-['Inter',system-ui,sans-serif] font-semibold text-white text-[13px]/4.5">
              Rizky Mahendra
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#AFC2D0] text-xs/4">
              Super Admin
            </div>
          </div>
          <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
            <polyline points="6 9 12 15 18 9" fill="none" stroke="#AFC2D0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
      </div>
      <div class="min-h-screen flex flex-col min-w-0 basis-[0%] grow bg-[#F7F9FC]">
        <div class="h-18 flex items-center justify-between shrink-0 px-10 bg-white border-b border-b-solid border-b-[#DDE6ED]">
          <div class="flex items-center gap-2.5">
            <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#6B8192] text-sm/5">
              Super Admin
            </div>
            <div class="font-['Inter',system-ui,sans-serif] text-[#B5C3CC] text-sm/5">
              /
            </div>
            <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#102A43] text-sm/5">
              Ringkasan
            </div>
          </div>
          <div class="flex items-center gap-2.5">
            <div class="flex items-center justify-center rounded-[10px] shrink-0 border border-solid border-[#DDE6ED] size-9">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <circle cx="12" cy="12" r="10" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M9.09 9a3 3 0 1 1 5.83 1c0 2-3 2-3 4" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M12 17h.01" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <div class="flex items-center justify-center rounded-[10px] relative shrink-0 border border-solid border-[#DDE6ED] size-9">
              <svg width="18" height="18" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M10 21h4" fill="none" stroke="#486174" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
              <div class="absolute top-2 right-2 rounded-[3px] bg-[#147D92] border border-solid border-[#FFFFFF] size-1.5"></div>
            </div>
          </div>
        </div>
        <div class="flex flex-col min-w-0 pt-9.5 pb-10 overflow-clip gap-6.5 basis-[0%] grow px-10">
          <div class="flex items-end justify-between gap-6">
            <div class="flex flex-col gap-2">
              <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
                PUSAT ADMINISTRASI
              </div>
              <div class="tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
                Selamat datang, Rizky
              </div>
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
                Pantau pengguna, keamanan, dan konfigurasi sistem dari satu tempat.
              </div>
            </div>
            <div class="h-10.5 flex items-center shrink-0 px-4 rounded-[10px] gap-2.25 bg-[#147D92] cursor-pointer hover:bg-[#0f677a] transition-colors">
              <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                <path d="M12 5v14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
                <path d="M5 12h14" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" />
              </svg>
              <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-sm/5">
                Tambah pengguna
              </div>
            </div>
          </div>
          <div class="flex gap-4">
            <div class="flex flex-col grow basis-[0%] min-w-0 p-4.5 rounded-[14px] gap-4.5 bg-white border border-solid border-[#DDE6ED]">
              <div class="flex items-start justify-between">
                <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] text-[13px]/4.5">
                  Total pengguna
                </div>
                <div class="w-8.5 h-8.5 flex items-center justify-center rounded-[9px] shrink-0 bg-[#E2F4F3]">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="9" cy="7" r="4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
              <div class="flex flex-col gap-1.25">
                <div class="tracking-[-0.03em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[28px]/8">
                  16
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-xs/4">
                  Naik 2 pengguna bulan ini
                </div>
              </div>
            </div>
            <div class="flex flex-col grow basis-[0%] min-w-0 p-4.5 rounded-[14px] gap-4.5 bg-white border border-solid border-[#DDE6ED]">
              <div class="flex items-start justify-between">
                <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] text-[13px]/4.5">
                  Pengguna aktif
                </div>
                <div class="w-8.5 h-8.5 flex items-center justify-center rounded-[9px] shrink-0 bg-[#E7F6EE]">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="9" cy="7" r="4" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <polyline points="16 11 18 13 22 9" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
              <div class="flex flex-col gap-1.25">
                <div class="tracking-[-0.03em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[28px]/8">
                  14
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-xs/4">
                  88% dari seluruh pengguna
                </div>
              </div>
            </div>
            <div class="flex flex-col grow basis-[0%] min-w-0 p-4.5 rounded-[14px] gap-4.5 bg-white border border-solid border-[#DDE6ED]">
              <div class="flex items-start justify-between">
                <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] text-[13px]/4.5">
                  Role terdaftar
                </div>
                <div class="w-8.5 h-8.5 flex items-center justify-center rounded-[9px] shrink-0 bg-[#EFE9FB]">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" fill="none" stroke="#7257B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="m9 12 2 2 4-4" fill="none" stroke="#7257B7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
              <div class="flex flex-col gap-1.25">
                <div class="tracking-[-0.03em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[28px]/8">
                  3
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-xs/4">
                  Admin, HR Admin, Reviewer
                </div>
              </div>
            </div>
            <div class="flex flex-col grow basis-[0%] min-w-0 p-4.5 rounded-[14px] gap-4.5 bg-white border border-solid border-[#DDE6ED]">
              <div class="flex items-start justify-between">
                <div class="font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] text-[13px]/4.5">
                  Backup terakhir
                </div>
                <div class="w-8.5 h-8.5 flex items-center justify-center rounded-[9px] shrink-0 bg-[#FFF3DF]">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                    <ellipse cx="12" cy="5" rx="8" ry="3" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 5v7c0 1.66 3.58 3 8 3s8-1.34 8-3V5" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M4 12v7c0 1.66 3.58 3 8 3s8-1.34 8-3v-7" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </div>
              </div>
              <div class="flex flex-col gap-1.25">
                <div class="tracking-[-0.03em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[28px]/8">
                  02.15
                </div>
                <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-xs/4">
                  Berhasil pada 10 Agu 2026
                </div>
              </div>
            </div>
          </div>
          <div class="flex grow basis-[0%] min-h-0 gap-4.5">
            <div class="grow-[1.45] basis-[0%] min-w-0 flex flex-col rounded-[14px] overflow-clip bg-white border border-solid border-[#DDE6ED]">
              <div class="flex items-start justify-between pt-5 pb-4 px-5.5 border-b border-b-solid border-b-[#EDF2F5]">
                <div class="flex flex-col gap-1.25">
                  <div class="tracking-[-0.015em] font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[17px]/5.75">
                    Aktivitas terbaru
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                    Perubahan penting pada sistem dan akun.
                  </div>
                </div>
                <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#147D92] text-[13px]/4.5 cursor-pointer hover:underline">
                  Lihat semua &rarr;
                </div>
              </div>
              <div class="flex flex-col grow basis-[0%] px-5.5">
                <div class="h-14.5 flex items-center gap-3 shrink-0 border-b border-b-solid border-b-[#EDF2F5]">
                  <div class="flex items-center justify-center shrink-0 rounded-[9px] bg-[#E2F4F3] size-8">
                    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                      <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <circle cx="9" cy="7" r="4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M19 8v6" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M22 11h-6" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </div>
                  <div class="flex flex-col grow basis-[0%] min-w-0 gap-0.75">
                    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#314E60] text-[13px]/4.5">
                      Nadia Putri mengundang 3 pengguna baru
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                      12 menit lalu
                    </div>
                  </div>
                </div>
                <div class="h-14.5 flex items-center gap-3 shrink-0 border-b border-b-solid border-b-[#EDF2F5]">
                  <div class="flex items-center justify-center shrink-0 rounded-[9px] bg-[#FFF3DF] size-8">
                    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                      <circle cx="12" cy="12" r="3" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06-2 2-.06-.06A1.65 1.65 0 0 0 16 18.4a1.65 1.65 0 0 0-1 1.51V20h-3v-.09A1.65 1.65 0 0 0 11 18.4a1.65 1.65 0 0 0-1.82.33l-.06.06-2-2 .06-.06A1.65 1.65 0 0 0 7.6 15a1.65 1.65 0 0 0-1.51-1H6v-3h.09A1.65 1.65 0 0 0 7.6 10a1.65 1.65 0 0 0-.33-1.82l-.06-.06 2-2 .06.06A1.65 1.65 0 0 0 11 5.6h.01A1.65 1.65 0 0 0 12 4.09V4h3v.09A1.65 1.65 0 0 0 16 5.6h.01a1.65 1.65 0 0 0 1.82-.33l.06-.06 2 2-.06.06A1.65 1.65 0 0 0 19.4 9v.01A1.65 1.65 0 0 0 20.91 10H21v3h-.09A1.65 1.65 0 0 0 19.4 14Z" fill="none" stroke="#D97706" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </div>
                  <div class="flex flex-col grow basis-[0%] min-w-0 gap-0.75">
                    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#314E60] text-[13px]/4.5">
                      Konfigurasi waktu sesi diperbarui
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                      1 jam lalu
                    </div>
                  </div>
                </div>
                <div class="h-14.5 flex items-center gap-3 shrink-0">
                  <div class="flex items-center justify-center shrink-0 rounded-[9px] bg-[#E7F6EE] size-8">
                    <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                      <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                      <path d="m9 12 2 2 4-4" fill="none" stroke="#198754" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </div>
                  <div class="flex flex-col grow basis-[0%] min-w-0 gap-0.75">
                    <div class="font-['Inter',system-ui,sans-serif] font-semibold text-[#314E60] text-[13px]/4.5">
                      Backup database berhasil dibuat
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-xs/4">
                      5 jam lalu
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="grow basis-[0%] min-w-0 flex flex-col rounded-[14px] overflow-clip bg-white border border-solid border-[#DDE6ED]">
              <div class="flex items-start justify-between pt-5 pb-4 px-5.5 border-b border-b-solid border-b-[#EDF2F5]">
                <div class="flex flex-col gap-1.25">
                  <div class="tracking-[-0.015em] font-['Inter',system-ui,sans-serif] font-bold text-[#102A43] text-[17px]/5.75">
                    Status sistem
                  </div>
                  <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[13px]/4.5">
                    Layanan inti berjalan normal.
                  </div>
                </div>
                <div class="h-6.5 flex items-center px-2.25 rounded-[13px] gap-1.5 bg-[#E7F6EE]">
                  <div class="rounded-[3px] shrink-0 bg-[#198754] size-1.5"></div>
                  <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#19734A] text-[11px]/4">
                    OPERASIONAL
                  </div>
                </div>
              </div>
              <div class="flex flex-col grow basis-[0%] px-5.5">
                <div class="h-13 flex items-center gap-2.5 shrink-0 border-b border-b-solid border-b-[#EDF2F5]">
                  <div class="shrink-0 rounded-sm bg-[#198754] size-2"></div>
                  <div class="flex flex-col grow basis-[0%] min-w-0 gap-0.5">
                    <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                      Aplikasi
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[11px]/3.75">
                      Semua layanan normal
                    </div>
                  </div>
                </div>
                <div class="h-13 flex items-center gap-2.5 shrink-0 border-b border-b-solid border-b-[#EDF2F5]">
                  <div class="shrink-0 rounded-sm bg-[#198754] size-2"></div>
                  <div class="flex flex-col grow basis-[0%] min-w-0 gap-0.5">
                    <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                      Database
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[11px]/3.75">
                      Tersinkronisasi 2 menit lalu
                    </div>
                  </div>
                </div>
                <div class="h-13 flex items-center gap-2.5 shrink-0 border-b border-b-solid border-b-[#EDF2F5]">
                  <div class="shrink-0 rounded-sm bg-[#198754] size-2"></div>
                  <div class="flex flex-col grow basis-[0%] min-w-0 gap-0.5">
                    <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                      Layanan email
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[11px]/3.75">
                      Siap mengirim undangan
                    </div>
                  </div>
                </div>
                <div class="h-13 flex items-center gap-2.5 shrink-0">
                  <div class="shrink-0 rounded-sm bg-[#D97706] size-2"></div>
                  <div class="flex flex-col grow basis-[0%] min-w-0 gap-0.5">
                    <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#314E60] text-[13px]/4.5">
                      Penyimpanan
                    </div>
                    <div class="font-['Inter',system-ui,sans-serif] text-[#7890A0] text-[11px]/3.75">
                      64% dari kapasitas terpakai
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>

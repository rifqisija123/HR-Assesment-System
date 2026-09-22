@extends('layouts.superadmin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
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
@endsection

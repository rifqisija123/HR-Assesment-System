@extends('layouts.superadmin')
@section('title', 'Riwayat Aktivitas')
@section('page_title', 'Riwayat aktivitas')

@section('content')
<div class="flex items-end justify-between gap-6">
            <div class="flex flex-col gap-2">
              <div class="tracking-[0.06em] font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[13px]/4.5">
                AUDIT LOGS
              </div>
              <div class="tracking-[-0.035em] font-['Inter',system-ui,sans-serif] font-[750] [font-variation-settings:'wght'_750] text-[#102A43] text-[32px]/9.5">
                Riwayat Aktivitas
              </div>
              <div class="font-['Inter',system-ui,sans-serif] text-[#62798A] text-[15px]/5.5">
                Pantau dan lacak semua tindakan penting yang dilakukan oleh pengguna, IP, dan peramban (browser).
              </div>
            </div>
            <div class="flex items-center gap-3">
              <div class="h-10.5 flex items-center shrink-0 px-4 rounded-[10px] gap-2.25 bg-white border border-solid border-[#DDE6ED] cursor-pointer hover:bg-gray-50 transition-colors">
                <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                  <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" fill="none" stroke="#62798A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-[#62798A] text-sm/5">
                  Filter
                </div>
              </div>
              <div class="relative group">
                <div class="h-10.5 flex items-center shrink-0 px-4 rounded-[10px] gap-2.25 bg-[#147D92] cursor-pointer hover:bg-[#0f677a] transition-colors">
                  <svg width="17" height="17" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="7 10 12 15 17 10" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="12" y1="15" x2="12" y2="3" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <div class="font-['Inter',system-ui,sans-serif] font-[650] [font-variation-settings:'wght'_650] text-white text-sm/5">
                    Ekspor Log
                  </div>
                  <svg width="14" height="14" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;" class="ml-1">
                    <polyline points="6 9 12 15 18 9" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
                
                <div class="absolute right-0 mt-2 w-44 bg-white rounded-[10px] shadow-lg border border-solid border-[#DDE6ED] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-10 flex flex-col overflow-hidden py-1.5">
                  <a href="#" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-[#F8FAFC] transition-colors decoration-none">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M14 2V8H20" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M8 13H16" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M8 17H16" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M10 9H8" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#314E60] text-[13px]">Ekspor sebagai XLSX</span>
                  </a>
                  <a href="#" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-[#F8FAFC] transition-colors decoration-none">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z" stroke="#E11D48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M14 2V8H20" stroke="#E11D48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M9 15V11H11C11.5304 11 12.0391 11.2107 12.4142 11.5858C12.7893 11.9609 13 12.4696 13 13C13 13.5304 12.7893 14.0391 12.4142 14.4142C12.0391 14.7893 11.5304 15 11 15H9Z" stroke="#E11D48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-['Inter',system-ui,sans-serif] font-medium text-[#314E60] text-[13px]">Ekspor sebagai PDF</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
          
          <div class="flex flex-col grow basis-[0%] min-w-0 bg-white rounded-[14px] border border-solid border-[#DDE6ED] overflow-clip">
            <div class="flex items-center justify-between p-5 border-b border-b-solid border-[#EDF2F5]">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <svg width="16" height="16" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                    <circle cx="11" cy="11" r="8" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65" fill="none" stroke="#94A3B8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </div>
                <input type="text" placeholder="Cari aktivitas, pengguna, atau IP..." class="h-10 pl-10 pr-4 text-sm font-['Inter',system-ui,sans-serif] border border-solid border-[#DDE6ED] rounded-[8px] bg-white outline-none focus:border-[#147D92] focus:ring-1 focus:ring-[#147D92] w-80 text-[#314E60] placeholder-[#94A3B8] transition-all">
              </div>
              <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#62798A]">
                Menampilkan 1-10 dari 248 aktivitas
              </div>
            </div>

            <div class="overflow-x-auto">
              <table class="w-full text-left border-collapse">
                <thead>
                  <tr class="bg-[#F8FAFC] border-b border-b-solid border-[#EDF2F5]">
                    <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Waktu</th>
                    <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Pengguna</th>
                    <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Aktivitas</th>
                    <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Entitas</th>
                    <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">IP Address</th>
                    <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider">Browser</th>
                    <th class="px-5 py-3.5 font-['Inter',system-ui,sans-serif] font-semibold text-[#62798A] text-[12px] uppercase tracking-wider text-right"></th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-[#EDF2F5]">
                  <!-- Row 1 -->
                  <tr class="hover:bg-[#F8FAFC] transition-colors cursor-default">
                    <td class="px-5 py-4 whitespace-nowrap">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">10 Agu 2026</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[12px] text-[#7890A0]">14:32:01 WIB</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-2.5">
                        <div class="flex items-center justify-center shrink-0 rounded-full bg-[#EFE9FB] size-7">
                          <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#7257B7] text-[10px]">NP</div>
                        </div>
                        <div class="flex flex-col min-w-0">
                          <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">Nadia Putri</div>
                          <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">HR Admin</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <span class="flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-[#E7F6EE] text-[#19734A] border border-[#198754]/20">Create</span>
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Membuat sesi tes baru</div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Test Session</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">ID: #TS-2091</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] font-mono text-[#62798A]">192.168.1.45</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Chrome 114.0</div>
                        <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">/ Windows</div>
                      </div>
                    </td>
                    <td class="px-5 py-4 text-right">
                      <button class="flex items-center justify-center p-1 bg-transparent border-none text-[#147D92] hover:text-[#0f677a] transition-colors cursor-pointer group" title="Lihat Detail">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current drop-shadow-[0_2px_4px_rgba(20,125,146,0.45)] group-hover:drop-shadow-[0_4px_6px_rgba(15,103,122,0.6)] transition-all duration-300 transform group-hover:scale-110">
                          <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </button>
                    </td>
                  </tr>

                  <!-- Row 2 -->
                  <tr class="hover:bg-[#F8FAFC] transition-colors cursor-default">
                    <td class="px-5 py-4 whitespace-nowrap">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">10 Agu 2026</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[12px] text-[#7890A0]">13:15:40 WIB</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-2.5">
                        <div class="flex items-center justify-center shrink-0 rounded-full bg-[#D1F0ED] size-7">
                          <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#125A6B] text-[10px]">RM</div>
                        </div>
                        <div class="flex flex-col min-w-0">
                          <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">Rizky Mahendra</div>
                          <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">Super Admin</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <span class="flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-[#FFF3DF] text-[#B45309] border border-[#D97706]/20">Update</span>
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Mengubah konfigurasi email</div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Company Setting</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">-</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] font-mono text-[#62798A]">114.120.35.12</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Safari 16.5</div>
                        <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">/ macOS</div>
                      </div>
                    </td>
                    <td class="px-5 py-4 text-right">
                      <button class="flex items-center justify-center p-1 bg-transparent border-none text-[#147D92] hover:text-[#0f677a] transition-colors cursor-pointer group" title="Lihat Detail">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current drop-shadow-[0_2px_4px_rgba(20,125,146,0.45)] group-hover:drop-shadow-[0_4px_6px_rgba(15,103,122,0.6)] transition-all duration-300 transform group-hover:scale-110">
                          <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </button>
                    </td>
                  </tr>
                  
                  <!-- Row 3 -->
                  <tr class="hover:bg-[#F8FAFC] transition-colors cursor-default">
                    <td class="px-5 py-4 whitespace-nowrap">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">10 Agu 2026</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[12px] text-[#7890A0]">11:05:22 WIB</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-2.5">
                        <div class="flex items-center justify-center shrink-0 rounded-full bg-[#FFE4E6] size-7">
                          <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#E11D48] text-[10px]">DA</div>
                        </div>
                        <div class="flex flex-col min-w-0">
                          <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">Dimas Aditya</div>
                          <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">Reviewer</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <span class="flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-[#F1F5F9] text-[#475569] border border-[#94A3B8]/20">Login</span>
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Berhasil masuk ke sistem</div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">User Session</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">-</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] font-mono text-[#62798A]">182.253.111.4</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Firefox 113.0</div>
                        <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">/ Windows</div>
                      </div>
                    </td>
                    <td class="px-5 py-4 text-right">
                      <button class="flex items-center justify-center p-1 bg-transparent border-none text-[#147D92] hover:text-[#0f677a] transition-colors cursor-pointer group" title="Lihat Detail">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current drop-shadow-[0_2px_4px_rgba(20,125,146,0.45)] group-hover:drop-shadow-[0_4px_6px_rgba(15,103,122,0.6)] transition-all duration-300 transform group-hover:scale-110">
                          <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </button>
                    </td>
                  </tr>

                  <!-- Row 4 -->
                  <tr class="hover:bg-[#F8FAFC] transition-colors cursor-default">
                    <td class="px-5 py-4 whitespace-nowrap">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">09 Agu 2026</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[12px] text-[#7890A0]">16:45:10 WIB</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-2.5">
                        <div class="flex items-center justify-center shrink-0 rounded-full bg-[#E2F4F3] size-7">
                          <div class="font-['Inter',system-ui,sans-serif] font-bold text-[#147D92] text-[10px]">SYS</div>
                        </div>
                        <div class="flex flex-col min-w-0">
                          <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60] font-medium">System Auto</div>
                          <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">System</div>
                        </div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <span class="flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-[#FEE2E2] text-[#B91C1C] border border-[#EF4444]/20">Delete</span>
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Menghapus data token kedaluwarsa</div>
                      </div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Invitation</div>
                      <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">Batch #502</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="font-['Inter',system-ui,sans-serif] text-[13px] font-mono text-[#62798A]">127.0.0.1</div>
                    </td>
                    <td class="px-5 py-4">
                      <div class="flex items-center gap-1.5">
                        <div class="font-['Inter',system-ui,sans-serif] text-[13px] text-[#314E60]">Server Cron</div>
                        <div class="font-['Inter',system-ui,sans-serif] text-[11px] text-[#7890A0]">/ Linux</div>
                      </div>
                    </td>
                    <td class="px-5 py-4 text-right">
                      <button class="flex items-center justify-center p-1 bg-transparent border-none text-[#147D92] hover:text-[#0f677a] transition-colors cursor-pointer group" title="Lihat Detail">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="stroke-current drop-shadow-[0_2px_4px_rgba(20,125,146,0.45)] group-hover:drop-shadow-[0_4px_6px_rgba(15,103,122,0.6)] transition-all duration-300 transform group-hover:scale-110">
                          <path d="M1 12C1 12 5 4 12 4C19 4 23 12 23 12C23 12 19 20 12 20C5 20 1 12 1 12Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                          <circle cx="12" cy="12" r="3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="flex items-center justify-between p-5 border-t border-t-solid border-[#EDF2F5]">
              <div class="flex gap-2">
                <button class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#62798A] hover:bg-[#F8FAFC] transition-colors disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                  Sebelumnya
                </button>
                <button class="h-8 px-3 rounded-[6px] border border-solid border-[#DDE6ED] bg-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium text-[#102A43] hover:bg-[#F8FAFC] transition-colors">
                  Selanjutnya
                </button>
              </div>
              <div class="flex items-center gap-1">
                <button class="size-8 rounded-[6px] bg-[#147D92] text-white text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center">1</button>
                <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">2</button>
                <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">3</button>
                <span class="text-[#62798A] px-1">...</span>
                <button class="size-8 rounded-[6px] bg-transparent text-[#62798A] hover:bg-[#F8FAFC] text-[13px] font-['Inter',system-ui,sans-serif] font-medium flex items-center justify-center transition-colors">25</button>
              </div>
            </div>
          </div>
@endsection

@extends('layouts.reviewer')

@section('title', 'Review essay')
@section('page_title', 'Review essay')

@section('content')
<div x-data="{
  search: '',
  selectedCandidateId: 1,
  showRubrik: false,
  openSessionDropdown: false,
  selectedSession: { id: 1, name: 'Leadership Trainee — Batch 08', pendingCount: 19, reviewedCount: 9, totalCount: 19, deadline: '12 Agu 2026' },
  sessions: [
    { id: 1, name: 'Leadership Trainee — Batch 08', pendingCount: 19, reviewedCount: 9, totalCount: 19, deadline: '12 Agu 2026' },
    { id: 2, name: 'Sales Associate — Q3', pendingCount: 6, reviewedCount: 14, totalCount: 20, deadline: '18 Agu 2026' },
    { id: 3, name: 'Graduate Development', pendingCount: 2, reviewedCount: 46, totalCount: 48, deadline: 'Selesai' }
  ],
  candidates: [
    {
      id: 1,
      sessionId: 1,
      name: 'Andi Pratama',
      initials: 'AP',
      avatarBg: '#D4ECEE',
      avatarText: '#147D92',
      essayNum: 'Essay #04',
      timeStatus: 'baru',
      category: 'ESSAY #04 · KOMPETENSI MANAJERIAL',
      question: 'Ceritakan pencapaian profesional yang paling Anda banggakan.',
      answer: 'Dalam dua tahun terakhir, saya memimpin tim lintas fungsi untuk memperbaiki proses onboarding pelanggan. Saya memetakan hambatan utama, menyusun alur baru bersama tim operasional, dan menjalankan uji coba selama enam minggu. Hasilnya, waktu onboarding berkurang 32% dan skor kepuasan pelanggan meningkat secara konsisten.',
      submittedAt: '10 Agu 2026 · 09.42 WIB',
      score: 17,
      maxScore: 20,
      notes: 'Jawaban menunjukkan kepemimpinan yang terukur dan dampak yang jelas. Tambahkan contoh tantangan yang dihadapi.'
    },
    {
      id: 2,
      sessionId: 1,
      name: 'Sari Wulandari',
      initials: 'SW',
      avatarBg: '#F0ECF9',
      avatarText: '#6B4FA1',
      essayNum: 'Essay #04',
      timeStatus: '2 jam',
      category: 'ESSAY #04 · KOMPETENSI MANAJERIAL',
      question: 'Bagaimana Anda mengelola konflik antar anggota tim dalam situasi bertekanan tinggi?',
      answer: 'Saya mengadakan sesi mediasi tatap muka, mendengarkan perspektif masing-masing pihak tanpa menghakimi, dan memfokuskan diskusi pada tujuan bersama proyek.',
      submittedAt: '10 Agu 2026 · 07.15 WIB',
      score: 15,
      maxScore: 20,
      notes: 'Pendekatan mediasi cukup baik. Bisa ditambahkan dampak langsung terhadap deadline tim.'
    },
    {
      id: 3,
      sessionId: 1,
      name: 'Rizky Adinata',
      initials: 'RA',
      avatarBg: '#E7F5EC',
      avatarText: '#198754',
      essayNum: 'Essay #07',
      timeStatus: '4 jam',
      category: 'ESSAY #07 · KEPEMIMPINAN STRATEGIS',
      question: 'Uraikan pengalaman Anda dalam mengimplementasikan perubahan besar pada operasional perusahaan.',
      answer: 'Saya memelopori migrasi sistem pencatatan manual ke platform digital terintegrasi. Meskipun sempat menghadapi resistensi internal, saya mengadakan program pelatihan komprehensif hingga adopsi mencapai 98%.',
      submittedAt: '10 Agu 2026 · 05.30 WIB',
      score: 18,
      maxScore: 20,
      notes: 'Inisiatif sangat kuat dan strategi manajemen perubahan (change management) sangat solid.'
    },
    {
      id: 4,
      sessionId: 1,
      name: 'Dewi Larasati',
      initials: 'DW',
      avatarBg: '#FFF3E0',
      avatarText: '#B16A00',
      essayNum: 'Essay #02',
      timeStatus: 'kemarin',
      category: 'ESSAY #02 · PROBLEM SOLVING',
      question: 'Jelaskan bagaimana Anda mengidentifikasi dan menyelesaikan bottleneck produksi.',
      answer: 'Dengan melakukan analisis value stream mapping, kami menemukan kelemahan pada tahap verifikasi data akhir. Kami melakukan otomatisasi validasi yang memangkas waktu proses hingga 40%.',
      submittedAt: '09 Agu 2026 · 14.20 WIB',
      score: 16,
      maxScore: 20,
      notes: 'Metodologi analisis jelas dan dampak efisiensi terukur.'
    },
    {
      id: 5,
      sessionId: 2,
      name: 'Reza Firmansyah',
      initials: 'RF',
      avatarBg: '#E6F4F7',
      avatarText: '#147D92',
      essayNum: 'Essay #01',
      timeStatus: '1 jam',
      category: 'ESSAY #01 · SALES STRATEGY',
      question: 'Bagaimana strategi Anda dalam mencapai target penjualan pada pasar baru?',
      answer: 'Saya melakukan analisis demografi target pasar dan membangun jejaring dengan pemangku kepentingan lokal untuk memperluas jangkauan penawaran produk.',
      submittedAt: '11 Agu 2026 · 10.15 WIB',
      score: 16,
      maxScore: 20,
      notes: 'Strategi penawaran terarah dan analisis pasar cukup baik.'
    },
    {
      id: 6,
      sessionId: 2,
      name: 'Dewi Anggraini',
      initials: 'DA',
      avatarBg: '#FFF3E0',
      avatarText: '#D97706',
      essayNum: 'Essay #03',
      timeStatus: '3 jam',
      category: 'ESSAY #03 · NEGOSIASI & KOMUNIKASI',
      question: 'Ceritakan pengalaman negosiasi tersulit dengan klien besar.',
      answer: 'Saat menghadapi keberatan harga dari calon mitra utama, saya menawarkan struktur penawaran berbasis nilai tambah yang menjaga margin perusahaan.',
      submittedAt: '11 Agu 2026 · 08.40 WIB',
      score: 14,
      maxScore: 20,
      notes: 'Teknik negosiasi berbasis nilai tambah dapat diperjelas dengan angka.'
    },
    {
      id: 7,
      sessionId: 3,
      name: 'Bima Saputra',
      initials: 'BS',
      avatarBg: '#E7F4F1',
      avatarText: '#147D92',
      essayNum: 'Essay #05',
      timeStatus: '1 hari',
      category: 'ESSAY #05 · LOGIKA & ANALISIS',
      question: 'Jelaskan solusi Anda terhadap permasalahan alokasi sumber daya terbatas.',
      answer: 'Saya mengelompokkan tugas berdasarkan matriks urgensi dan dampak, lalu mengalokasikan tim pada area prioritas tinggi secara fleksibel.',
      submittedAt: '08 Agu 2026 · 16.00 WIB',
      score: 19,
      maxScore: 20,
      notes: 'Penjelasan matriks prioritas sangat rapi dan logis.'
    }
  ],
  get sessionCandidates() {
    return this.candidates.filter(c => c.sessionId === this.selectedSession.id);
  },
  get currentCandidate() {
    const list = this.sessionCandidates;
    return list.find(c => c.id === this.selectedCandidateId) || list[0] || this.candidates[0];
  },
  get filteredCandidates() {
    let list = this.sessionCandidates;
    if (!this.search.trim()) return list;
    return list.filter(c => c.name.toLowerCase().includes(this.search.toLowerCase()));
  },
  selectSession(s) {
    this.selectedSession = s;
    this.openSessionDropdown = false;
    const firstCand = this.candidates.find(c => c.sessionId === s.id);
    if (firstCand) {
      this.selectedCandidateId = firstCand.id;
    }
  },
  saveFinal() {
    alert('Penilaian untuk ' + this.currentCandidate.name + ' (Skor: ' + this.currentCandidate.score + '/20) berhasil disimpan!');
  },
  skipNext() {
    const list = this.sessionCandidates;
    if (list.length === 0) return;
    const currentIndex = list.findIndex(c => c.id === this.selectedCandidateId);
    const nextIndex = (currentIndex + 1) % list.length;
    this.selectedCandidateId = list[nextIndex].id;
  }
}" class="flex flex-col gap-[18px]">

  {{-- Top Header Section --}}
  <div class="flex items-end justify-between">
    <div class="flex flex-col gap-[7px]">
      <div class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold tracking-[0.12em]">
        PENILAIAN MANUAL
      </div>
      <h1 class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[28px]/[34px] font-extrabold m-0">
        Review essay
      </h1>
      <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[13px]/[16px]">
        Tinjau jawaban, beri skor, dan tambahkan catatan untuk kandidat.
      </div>
    </div>
    <div class="flex items-center gap-[10px]">
      {{-- Batch Selector Dropdown --}}
      <div class="relative" @click.away="openSessionDropdown = false">
        <button 
          @click="openSessionDropdown = !openSessionDropdown"
          type="button"
          class="flex items-center h-[38px] px-[13px] bg-white border border-[#D9E2EA] rounded-[9px] gap-[10px] cursor-pointer hover:border-[#147D92] transition-colors outline-none"
        >
          <span class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-medium" x-text="selectedSession.name"></span>
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#8A9AAA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200 shrink-0" :class="openSessionDropdown ? 'rotate-180' : ''">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>

        {{-- Dropdown Menu Items --}}
        <div 
          x-show="openSessionDropdown"
          x-transition:enter="transition ease-out duration-150"
          x-transition:enter-start="opacity-0 scale-95"
          x-transition:enter-end="opacity-100 scale-100"
          x-transition:leave="transition ease-in duration-100"
          x-transition:leave-start="opacity-100 scale-100"
          x-transition:leave-end="opacity-0 scale-95"
          class="absolute right-0 top-[44px] z-30 w-[290px] bg-white border border-[#DCE6EC] rounded-[10px] shadow-lg py-1.5 overflow-hidden"
          style="display: none;"
        >
          <div class="px-3 py-1.5 text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[10px] font-bold tracking-wider uppercase border-b border-[#E6EDF2]">
            PILIH SESI TES
          </div>
          <div class="max-h-[220px] overflow-y-auto">
            <template x-for="s in sessions" :key="s.id">
              <button
                type="button"
                @click="selectSession(s)"
                class="w-full text-left px-3.5 py-2.5 flex items-center justify-between hover:bg-[#F7F9FC] transition-colors border-none bg-transparent cursor-pointer"
                :class="selectedSession.id === s.id ? 'bg-[#EAF6F7] text-[#147D92] font-semibold' : 'text-[#52677A]'"
              >
                <div class="flex flex-col gap-0.5 min-w-0">
                  <span class="text-[12px]/[16px] truncate font-['Inter',system-ui,sans-serif]" x-text="s.name"></span>
                  <span class="text-[10px]/[12px] text-[#7A8A9A] font-['Inter',system-ui,sans-serif]" x-text="s.pendingCount > 0 ? (s.pendingCount + ' essay belum dinilai') : 'Selesai dinilai'"></span>
                </div>
                <span x-show="selectedSession.id === s.id" class="text-[#147D92] font-bold text-[14px] ml-2">&check;</span>
              </button>
            </template>
          </div>
        </div>
      </div>

      {{-- Pending Count Badge --}}
      <div class="flex items-center h-[38px] px-[14px] bg-white border border-[#D9E2EA] rounded-[9px]">
        <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold" x-text="selectedSession.pendingCount > 0 ? (selectedSession.pendingCount + ' belum dinilai') : 'Semua selesai'">
        </span>
      </div>
    </div>
  </div>

  {{-- Progress Review Banner --}}
  <div class="flex items-center gap-[14px] py-[14px] px-[18px] bg-white border border-[#DCE6EC] rounded-[12px]">
    <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold shrink-0">
      Progress review
    </div>
    <div class="flex-1 bg-[#E6EDF2] rounded-full h-[7px] overflow-hidden">
      <div 
        class="bg-[#147D92] rounded-full h-[7px] transition-all duration-300"
        :style="'width: ' + Math.round((selectedSession.reviewedCount / selectedSession.totalCount) * 100) + '%'"
      ></div>
    </div>
    <div class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0" x-text="selectedSession.reviewedCount + ' dari ' + selectedSession.totalCount + ' essay'">
    </div>
    <div class="w-[1px] h-[22px] bg-[#DCE6EC] shrink-0"></div>
    <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0" x-text="'Batas sesi: ' + selectedSession.deadline">
    </div>
  </div>

  {{-- 3-Column Main Content Workspace --}}
  <div class="flex gap-[14px] min-h-[580px]">

    {{-- Column 1: Antrean Essay List --}}
    <div class="w-[235px] shrink-0 bg-white border border-[#DCE6EC] rounded-[12px] flex flex-col overflow-hidden">
      {{-- Header & Search --}}
      <div class="p-4 border-b border-[#E6EDF2] flex flex-col gap-[10px]">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px]/[16px] font-extrabold">
          Antrean essay
        </div>
        <div class="flex items-center h-[34px] px-[10px] gap-2 border border-[#D9E2EA] rounded-[8px] focus-within:border-[#147D92] transition-colors">
          <span class="text-[#A0AEC0] text-[15px]/[18px] font-['Inter',system-ui,sans-serif]">⌕</span>
          <input 
            type="text" 
            x-model="search" 
            placeholder="Cari kandidat..." 
            class="w-full text-[11px]/[14px] text-[#102A43] placeholder-[#A0AEC0] border-none outline-none bg-transparent font-['Inter',system-ui,sans-serif]" 
          />
        </div>
      </div>

      {{-- Waiting Queue Subheader --}}
      <div class="flex items-center justify-between py-[10px] px-4 bg-[#F8FAFC]">
        <span class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-bold tracking-[0.08em]">
          MENUNGGU
        </span>
        <span class="inline-block py-[3px] px-[7px] bg-[#FFF3E0] rounded-full text-[#B16A00] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-bold tracking-[0.08em]">
          19
        </span>
      </div>

      {{-- Candidate List Items --}}
      <div class="flex flex-col flex-1 overflow-y-auto">
        <template x-for="c in filteredCandidates" :key="c.id">
          <div 
            @click="selectedCandidateId = c.id"
            :class="selectedCandidateId === c.id 
              ? 'bg-[#EAF6F7] border-l-[3px] border-l-[#147D92]' 
              : 'bg-white hover:bg-[#F8FAFC] border-l-[3px] border-l-transparent'"
            class="flex items-center gap-[10px] py-[13px] px-[14px] border-b border-[#E6EDF2] cursor-pointer transition-colors"
          >
            {{-- Avatar Initials --}}
            <div 
              class="w-[30px] h-[30px] rounded-[9px] flex items-center justify-center shrink-0"
              :style="'background-color: ' + c.avatarBg"
            >
              <span 
                class="font-['Inter',system-ui,sans-serif] text-[10px]/[12px] font-extrabold"
                :style="'color: ' + c.avatarText"
                x-text="c.initials"
              ></span>
            </div>
            {{-- Info --}}
            <div class="flex flex-col gap-[3px] min-w-0 flex-1">
              <div 
                class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold truncate"
                x-text="c.name"
              ></div>
              <div 
                class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[10px]/[12px] truncate"
                x-text="c.essayNum + ' · ' + c.timeStatus"
              ></div>
            </div>
          </div>
        </template>

        <div x-show="filteredCandidates.length === 0" class="p-4 text-center text-[#7A8A9A] text-[11px]">
          Kandidat tidak ditemukan
        </div>
      </div>
    </div>

    {{-- Column 2: Essay Detail & Answer --}}
    <div class="flex-1 bg-white border border-[#DCE6EC] rounded-[12px] p-[20px] flex flex-col gap-[16px]">
      {{-- Question Header --}}
      <div class="flex items-start justify-between">
        <div class="flex flex-col gap-[5px] flex-1 pr-4">
          <div 
            class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold tracking-[0.08em]"
            x-text="currentCandidate.category"
          ></div>
          <h2 
            class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[18px]/[22px] font-extrabold m-0"
            x-text="currentCandidate.question"
          ></h2>
        </div>
        <div 
          class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] shrink-0 font-medium"
          x-text="currentCandidate.name"
        ></div>
      </div>

      {{-- Candidate Answer Box --}}
      <div class="bg-[#F7F9FC] border border-[#E6EDF2] rounded-[10px] py-[16px] px-[18px]">
        <div 
          class="text-[#324A5F] font-['Inter',system-ui,sans-serif] text-[14px]/[22px]"
          x-text="currentCandidate.answer"
        ></div>
      </div>

      {{-- Submission Time Meta --}}
      <div class="flex items-center gap-[10px]">
        <div class="w-[7px] h-[7px] rounded-full bg-[#147D92] shrink-0"></div>
        <div 
          class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px]"
          x-text="'Dikirim ' + currentCandidate.submittedAt"
        ></div>
      </div>

      {{-- Rubric Footer Info --}}
      <div class="flex items-center justify-between pt-[10px] border-t border-[#E6EDF2] mt-auto">
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          Gunakan rubrik untuk menilai jawaban secara konsisten.
        </div>
        <button 
          @click="showRubrik = true"
          type="button"
          class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold hover:underline cursor-pointer bg-transparent border-none p-0 flex items-center gap-1"
        >
          Lihat rubrik &rarr;
        </button>
      </div>
    </div>

    {{-- Column 3: Penilaian Manual Form --}}
    <div class="w-[280px] shrink-0 bg-white border border-[#DCE6EC] rounded-[12px] p-[20px] flex flex-col gap-[16px]">
      {{-- Section Title --}}
      <div class="flex flex-col gap-[5px]">
        <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[14px]/[18px] font-extrabold">
          Penilaian manual
        </div>
        <div class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px]">
          Nilai maksimal 20 poin
        </div>
      </div>

      {{-- Score Input Field --}}
      <div class="flex flex-col gap-[8px]">
        <label class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold uppercase">
          SKOR ESSAY
        </label>
        <div class="flex items-center gap-[8px]">
          <div class="flex-1 h-[48px] px-[14px] border border-[#B8CBD6] rounded-[9px] flex items-center focus-within:border-[#147D92] focus-within:ring-1 focus-within:ring-[#147D92] transition-colors">
            <input 
              type="number" 
              x-model.number="currentCandidate.score"
              min="0"
              max="20"
              class="w-full text-[#102A43] font-['Inter',system-ui,sans-serif] text-[22px]/[28px] font-extrabold border-none outline-none bg-transparent"
            />
          </div>
          <span class="text-[#7A8A9A] font-['Inter',system-ui,sans-serif] text-[16px]/[20px]">
            / 20
          </span>
        </div>
      </div>

      {{-- Reviewer Notes Field --}}
      <div class="flex flex-col gap-[8px]">
        <label class="text-[#52677A] font-['Inter',system-ui,sans-serif] text-[11px]/[14px] font-bold uppercase">
          CATATAN REVIEWER
        </label>
        <div class="border border-[#D9E2EA] rounded-[9px] p-[12px] h-[105px] focus-within:border-[#147D92] transition-colors">
          <textarea 
            x-model="currentCandidate.notes"
            placeholder="Tambahkan catatan untuk kandidat..."
            class="w-full h-full text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[18px] border-none outline-none resize-none bg-transparent placeholder-[#A0AEC0]"
          ></textarea>
        </div>
      </div>

      {{-- Bottom Action Buttons --}}
      <div class="flex flex-col gap-[8px] mt-auto">
        <button 
          @click="saveFinal()"
          type="button"
          class="h-[40px] w-full bg-[#17879A] hover:bg-[#147D92] text-white font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold rounded-[9px] flex items-center justify-center cursor-pointer transition-colors border-none shadow-xs"
        >
          Simpan & finalisasi
        </button>
        <button 
          @click="skipNext()"
          type="button"
          class="h-[40px] w-full bg-white border border-[#D9E2EA] hover:bg-[#F8FAFC] text-[#52677A] font-['Inter',system-ui,sans-serif] text-[12px]/[16px] font-bold rounded-[9px] flex items-center justify-center cursor-pointer transition-colors"
        >
          Lewati sementara
        </button>
      </div>
    </div>

  </div>

  {{-- Modal Rubrik Penilaian --}}
  <div 
    x-show="showRubrik" 
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-[#102A43]/50 backdrop-blur-xs"
    style="display: none;"
  >
    <div 
      @click.away="showRubrik = false"
      class="bg-white rounded-[16px] shadow-xl border border-[#DCE6EC] w-full max-w-[560px] overflow-hidden flex flex-col"
    >
      {{-- Modal Header --}}
      <div class="flex items-center justify-between px-6 py-4 border-b border-[#E6EDF2] bg-[#F8FAFC]">
        <div class="flex flex-col gap-0.5">
          <div class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[16px] font-extrabold">
            Rubrik Penilaian Essay
          </div>
          <div class="text-[#6B7C93] font-['Inter',system-ui,sans-serif] text-[12px]">
            Panduan pemberian skor (Maksimal 20 Poin)
          </div>
        </div>
        <button 
          @click="showRubrik = false"
          class="text-[#7A8A9A] hover:text-[#102A43] text-[20px] font-bold bg-transparent border-none cursor-pointer"
        >
          &times;
        </button>
      </div>

      {{-- Modal Body --}}
      <div class="p-6 flex flex-col gap-4 max-h-[70vh] overflow-y-auto">
        <div class="flex flex-col gap-3">
          {{-- Tier 1: 16-20 --}}
          <div class="p-3.5 rounded-[10px] border border-[#D4ECEE] bg-[#EAF6F7] flex flex-col gap-1">
            <div class="flex items-center justify-between">
              <span class="text-[#147D92] font-['Inter',system-ui,sans-serif] text-[13px] font-bold">16 - 20 Poin (Sangat Baik / Istimewa)</span>
              <span class="px-2 py-0.5 rounded-full bg-[#147D92] text-white text-[10px] font-bold">Unggul</span>
            </div>
            <p class="text-[#324A5F] text-[12px]/[18px] m-0">
              Jawaban memberikan contoh konkret, data terukur (metrik/persentase), metodologi terstruktur, serta dampak positif yang jelas bagi tim atau perusahaan.
            </p>
          </div>

          {{-- Tier 2: 11-15 --}}
          <div class="p-3.5 rounded-[10px] border border-[#E6EDF2] bg-white flex flex-col gap-1">
            <div class="flex items-center justify-between">
              <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px] font-bold">11 - 15 Poin (Baik)</span>
              <span class="px-2 py-0.5 rounded-full bg-[#E6EDF2] text-[#52677A] text-[10px] font-bold">Sesuai Standar</span>
            </div>
            <p class="text-[#52677A] text-[12px]/[18px] m-0">
              Jawaban terstruktur dengan baik dan logis, menyebutkan peran pribadi, namun metrik dampak atau detail kontekstual masih kurang mendalam.
            </p>
          </div>

          {{-- Tier 3: 6-10 --}}
          <div class="p-3.5 rounded-[10px] border border-[#E6EDF2] bg-white flex flex-col gap-1">
            <div class="flex items-center justify-between">
              <span class="text-[#102A43] font-['Inter',system-ui,sans-serif] text-[13px] font-bold">6 - 10 Poin (Cukup)</span>
              <span class="px-2 py-0.5 rounded-full bg-[#FFF3E0] text-[#B16A00] text-[10px] font-bold">Perlu Perbaikan</span>
            </div>
            <p class="text-[#52677A] text-[12px]/[18px] m-0">
              Jawaban umum/normatif tanpa contoh spesifik. Kurang menjelaskan tindakan personal atau solusi konkret yang diambil.
            </p>
          </div>

          {{-- Tier 4: 0-5 --}}
          <div class="p-3.5 rounded-[10px] border border-[#FFE8E8] bg-[#FFF5F5] flex flex-col gap-1">
            <div class="flex items-center justify-between">
              <span class="text-[#C53030] font-['Inter',system-ui,sans-serif] text-[13px] font-bold">0 - 5 Poin (Kurang)</span>
              <span class="px-2 py-0.5 rounded-full bg-[#FFE8E8] text-[#C53030] text-[10px] font-bold">Tidak Memenuhi</span>
            </div>
            <p class="text-[#742A2A] text-[12px]/[18px] m-0">
              Jawaban sangat singkat, tidak relevan dengan pertanyaan essay, atau tidak menyelesaikan tugas essay.
            </p>
          </div>
        </div>
      </div>

      {{-- Modal Footer --}}
      <div class="px-6 py-3.5 border-t border-[#E6EDF2] bg-[#F8FAFC] flex justify-end">
        <button 
          @click="showRubrik = false"
          class="px-4 h-[36px] bg-[#17879A] hover:bg-[#147D92] text-white font-['Inter',system-ui,sans-serif] text-[12px] font-bold rounded-[8px] cursor-pointer border-none transition-colors"
        >
          Tutup Rubrik
        </button>
      </div>
    </div>
  </div>

</div>
@endsection

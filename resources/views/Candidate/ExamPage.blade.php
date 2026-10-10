@extends('layouts.candidate')

@section('title', 'Lembar Ujian — Technical Assessment')

@section('content')
<div 
    x-data="examApp()" 
    x-init="initTimer()"
    class="min-h-screen flex flex-col bg-[#F8FAFC] text-[#0F172A] select-none"
>
    <!-- Top Bar / Exam Header -->
    <header class="h-[72px] bg-[#102A43] border-b border-[#1E3A56] px-4 md:px-8 lg:px-9 grid grid-cols-2 md:grid-cols-[1fr_auto_1fr] items-center shrink-0 sticky top-0 z-30 shadow-sm">
        
        <!-- Left: Brand & Assessment Meta -->
        <div class="flex items-center gap-3.5 justify-self-start">
            <div class="w-[38px] h-[38px] rounded-[10px] bg-[#147D92] flex items-center justify-center shrink-0 shadow-inner">
                <span class="font-sans font-extrabold text-white text-[19px] leading-none">V</span>
            </div>
            <div class="flex flex-col">
                <div class="flex items-center gap-2 flex-wrap">
                    <h1 class="font-sans font-bold text-white text-[15px] leading-[18px] tracking-[-0.01em] m-0 whitespace-nowrap">
                        Technical Assessment — Senior Backend Engineer
                    </h1>
                    <div class="bg-[#1D4C63] rounded-[6px] px-2 py-0.5 inline-flex items-center shrink-0">
                        <span class="font-sans font-semibold text-[#75D5D0] text-[11px] leading-[14px] uppercase tracking-wider">
                            SESI AKTIF
                        </span>
                    </div>
                </div>
                <div class="font-sans text-[#94A3B8] text-xs leading-4 mt-0.5 whitespace-nowrap">
                    Kandidat: <span class="text-[#CBD5E1] font-medium">Ahmad Fauzi</span> • Token: <span class="font-mono text-[#CBD5E1]">VRTA-8921-TK48</span>
                </div>
            </div>
        </div>

        <!-- Center: Countdown Timer Box -->
        <div class="hidden md:flex items-center justify-center justify-self-center">
            <div class="flex items-center gap-2.5 bg-[#1E3A56] border border-[#334E68] rounded-[12px] px-4.5 py-2 shadow-sm">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 text-[#F59E0B]">
                    <circle cx="12" cy="12" r="10" stroke="#F59E0B" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <polyline points="12 6 12 12 16 14" stroke="#F59E0B" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="flex flex-col items-start">
                    <span class="font-sans font-semibold text-[#CBD5E1] text-[10px] leading-3 uppercase tracking-[0.05em]">
                        Sisa Waktu Pengerjaan
                    </span>
                    <span class="font-mono font-bold text-[#F8FAFC] text-[18px] leading-[22px] tracking-[0.04em]" x-text="timerDisplay">
                        01 : 14 : 32
                    </span>
                </div>
            </div>
        </div>

        <!-- Right: Autosave Indicator -->
        <div class="flex items-center gap-3.5 justify-self-end">
            <!-- Mobile Timer Pill -->
            <div class="flex md:hidden items-center gap-1.5 bg-[#1E3A56] border border-[#334E68] rounded-lg px-2.5 py-1.5">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2.2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                <span class="font-mono font-bold text-[#F8FAFC] text-xs" x-text="timerDisplay">01:14:32</span>
            </div>

            <!-- Autosave Indicator -->
            <div class="hidden sm:flex items-center gap-2 bg-[#16364D] rounded-[8px] px-3 py-1.5 border border-[#1E435E]/40 whitespace-nowrap">
                <div class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></div>
                <span class="font-sans font-medium text-[#6EE7B7] text-xs leading-4">
                    Autosave: Tersimpan <span x-text="lastSavedTime">15:42</span> WIB
                </span>
            </div>
        </div>
    </header>

    <!-- Main Content Work Area -->
    <main class="flex-1 flex flex-col lg:flex-row gap-6 p-4 sm:p-6 lg:p-9 max-w-[1440px] w-full mx-auto">
        
        <!-- Left Column: Question & Options Area -->
        <section class="flex-1 flex flex-col justify-between bg-white border border-[#E2E8F0] rounded-[14px] shadow-[0_4px_12px_rgba(16,42,67,0.04)] p-6 md:p-7 min-h-[580px]">
            
            <div class="flex flex-col gap-4">
                
                <!-- Question Header Row -->
                <div class="flex items-center justify-between pb-3.5 border-b border-[#F1F5F9] flex-wrap gap-2.5">
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <h2 class="font-sans font-extrabold text-[#0F172A] text-[18px] leading-[22px] m-0">
                            Soal No. <span x-text="currentQuestion.number">14</span>
                        </h2>
                        <span class="font-sans font-medium text-[#64748B] text-xs leading-4">
                            dari <span x-text="questions.length">25</span> Soal
                        </span>
                        <div class="bg-[#E0F2FE] rounded-[6px] px-2 py-0.75 inline-flex items-center">
                            <span class="font-sans font-semibold text-[#0369A1] text-[11px] leading-3.5" x-text="currentQuestion.category">
                                MySQL & Database Concurrency
                            </span>
                        </div>
                        <div class="bg-[#F1F5F9] rounded-[6px] px-2 py-0.75 inline-flex items-center">
                            <span class="font-sans font-semibold text-[#475569] text-[11px] leading-3.5" x-text="'Bobot: ' + currentQuestion.points + ' Poin'">
                                Bobot: 4 Poin
                            </span>
                        </div>
                    </div>

                    <!-- Doubtful / Flag Button -->
                    <button 
                        type="button" 
                        @click="toggleDoubtful()"
                        :class="currentQuestion.isDoubtful ? 'bg-[#FEF3C7] border-[#FDE68A] text-[#B45309]' : 'bg-white border-[#CBD5E1] text-[#475569] hover:bg-[#F8FAFC]'"
                        class="flex items-center gap-1.5 border rounded-[8px] px-3 py-1.5 text-xs font-sans font-semibold transition-colors cursor-pointer"
                    >
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                            <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z" :fill="currentQuestion.isDoubtful ? '#F59E0B' : 'none'" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <line x1="4" y1="22" x2="4" y2="15" stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span x-text="currentQuestion.isDoubtful ? 'Ragu-ragu (Ditandai)' : 'Tandai Ragu-ragu'">Tandai Ragu-ragu</span>
                    </button>
                </div>

                <!-- Question Text & Code Snippet Box -->
                <div class="flex flex-col gap-3">
                    <p class="font-sans font-semibold text-[#1E293B] text-[15px] leading-6 m-0" x-text="currentQuestion.text">
                        Pada arsitektur sistem backend dengan database MySQL InnoDB yang melayani ribuan transaksi pembelian per detik, strategi manakah yang paling efektif untuk mencegah terjadinya Deadlock pada tabel inventaris ketika beberapa transaksi memperbarui stok secara bersamaan?
                    </p>

                    <!-- Code Snippet Box (If present) -->
                    <template x-if="currentQuestion.codeSnippet">
                        <div class="bg-[#0F172A] rounded-[8px] p-3.5 px-4 flex flex-col gap-1 font-mono">
                            <!-- Code snippet header -->
                            <div class="flex items-center justify-between pb-1.5 mb-1 border-b border-[#334155]">
                                <span class="text-[#94A3B8] text-[11px] leading-3.5 font-mono" x-text="currentQuestion.codeSnippet.filename">
                                    sql_transaction_snippet.sql
                                </span>
                                <span class="text-[#38BDF8] text-[10px] leading-3 font-mono" x-text="currentQuestion.codeSnippet.badge">
                                    InnoDB Transaction Block
                                </span>
                            </div>
                            <!-- Code Lines -->
                            <div class="text-[12.5px] leading-5 flex flex-col space-y-0.5">
                                <span class="text-[#F1F5F9]">START TRANSACTION;</span>
                                <span class="text-[#38BDF8]">SELECT stock FROM products WHERE id = :product_id FOR UPDATE;</span>
                                <span class="text-[#94A3B8]">-- Pemrosesan pesanan dan pengurangan inventaris</span>
                                <span class="text-[#38BDF8]">UPDATE products SET stock = stock - :qty WHERE id = :product_id;</span>
                                <span class="text-[#F1F5F9]">COMMIT;</span>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Multiple Choice Options List -->
                <div class="flex flex-col gap-2.5 mt-1">
                    <template x-for="option in currentQuestion.options" :key="option.id">
                        <div 
                            @click="selectOption(option.id)"
                            :class="currentQuestion.selectedAnswer === option.id 
                                ? 'bg-[#F0FDFA] border-2 border-[#147D92] shadow-[0_2px_8px_rgba(20,125,146,0.08)]' 
                                : 'bg-white border-[1.5px] border-[#E2E8F0] hover:border-[#CBD5E1] hover:bg-[#F8FAFC]'"
                            class="flex items-center gap-3 p-3 px-4 rounded-[10px] transition-all cursor-pointer select-none"
                        >
                            <!-- Circle Option Identifier -->
                            <div 
                                :class="currentQuestion.selectedAnswer === option.id 
                                    ? 'bg-[#147D92] text-white border-[#147D92]' 
                                    : 'border-[1.5px] border-[#CBD5E1] text-[#64748B] bg-transparent'"
                                class="w-[26px] h-[26px] rounded-full flex items-center justify-center shrink-0 transition-colors"
                            >
                                <span class="font-sans font-bold text-xs leading-none" x-text="option.id"></span>
                            </div>

                            <!-- Option Description Text -->
                            <div 
                                :class="currentQuestion.selectedAnswer === option.id 
                                    ? 'text-[#0F172A] font-semibold' 
                                    : 'text-[#334155] font-normal'"
                                class="font-sans text-[13.5px] leading-5"
                                x-text="option.text"
                            ></div>
                        </div>
                    </template>
                </div>

            </div>

            <!-- Bottom Question Navigation Buttons -->
            <div class="flex items-center justify-between pt-4 mt-6 border-t border-[#F1F5F9]">
                <!-- Previous Question Button -->
                <button 
                    type="button" 
                    @click="prevQuestion()"
                    :disabled="currentIndex === 0"
                    :class="currentIndex === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#F8FAFC] cursor-pointer active:scale-[0.99]'"
                    class="flex items-center gap-2 bg-white border-[1.5px] border-[#CBD5E1] rounded-[9px] px-6 py-2.5 text-[#334155] font-sans font-semibold text-[13px] leading-4 transition-all"
                >
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#475569" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                    <span>Soal Sebelumnya <template x-if="currentIndex > 0"><span x-text="'(No. ' + questions[currentIndex - 1].number + ')'"></span></template></span>
                </button>

                <!-- Next Question Button -->
                <button 
                    type="button" 
                    @click="nextQuestion()"
                    :disabled="currentIndex === questions.length - 1"
                    :class="currentIndex === questions.length - 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#0E6273] cursor-pointer active:scale-[0.99]'"
                    class="flex items-center gap-2 bg-[#147D92] text-white rounded-[9px] px-5 py-2.5 font-sans font-bold text-[13px] leading-4 transition-all shadow-[0_4px_12px_rgba(20,125,146,0.25)]"
                >
                    <span>Soal Selanjutnya <template x-if="currentIndex < questions.length - 1"><span x-text="'(No. ' + questions[currentIndex + 1].number + ')'"></span></template></span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>

        </section>

        <!-- Right Column: Navigation Grid & Summary -->
        <aside class="w-full lg:w-[360px] flex flex-col justify-between gap-4 bg-white border border-[#E2E8F0] rounded-[14px] shadow-[0_4px_12px_rgba(16,42,67,0.04)] p-5 shrink-0">
            
            <div class="flex flex-col gap-4">
                
                <!-- Progress Header -->
                <div class="flex flex-col gap-2">
                    <div class="flex items-center justify-between">
                        <span class="font-sans font-bold text-[#0F172A] text-sm leading-[18px]">
                            Navigasi Nomor Soal
                        </span>
                        <span class="font-sans font-bold text-[#147D92] text-xs leading-4">
                            <span x-text="answeredCount">18</span> / <span x-text="questions.length">25</span> Terjawab (<span x-text="progressPercentage">72</span>%)
                        </span>
                    </div>
                    <!-- Progress Bar Track -->
                    <div class="w-full bg-[#E2E8F0] h-2 rounded-full overflow-hidden">
                        <div 
                            class="bg-[#147D92] h-full rounded-full transition-all duration-300"
                            :style="'width: ' + progressPercentage + '%'"
                        ></div>
                    </div>
                </div>

                <!-- Legend Summary Box -->
                <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-lg p-2.5 flex flex-wrap items-center gap-x-3.5 gap-y-1.5">
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-[3px] bg-[#10B981] shrink-0"></div>
                        <span class="font-sans font-medium text-[#475569] text-[10.5px] leading-3.5">
                            Terjawab (<span x-text="answeredCount">18</span>)
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-[3px] bg-[#F59E0B] shrink-0"></div>
                        <span class="font-sans font-medium text-[#475569] text-[10.5px] leading-3.5">
                            Ragu-ragu (<span x-text="doubtfulCount">2</span>)
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-[3px] bg-white border border-[#CBD5E1] shrink-0"></div>
                        <span class="font-sans font-medium text-[#475569] text-[10.5px] leading-3.5">
                            Belum (<span x-text="unansweredCount">5</span>)
                        </span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 rounded-[3px] bg-[#0284C7] shrink-0"></div>
                        <span class="font-sans font-medium text-[#475569] text-[10.5px] leading-3.5">
                            Aktif
                        </span>
                    </div>
                </div>

                <!-- Grid Part 1: Multiple Choice (1 - 20) -->
                <div class="flex flex-col gap-2">
                    <span class="font-sans font-bold text-[#64748B] text-[11px] leading-3.5 uppercase tracking-wider">
                        Bagian 1: Pilihan Ganda (1 - 20)
                    </span>
                    <div class="grid grid-cols-5 gap-2">
                        <template x-for="(q, index) in questions.slice(0, 20)" :key="q.number">
                            <button 
                                type="button"
                                @click="jumpToQuestion(index)"
                                :class="getQuestionClass(q, index)"
                                class="h-9 rounded-lg flex items-center justify-center font-sans text-[13px] transition-all cursor-pointer select-none"
                            >
                                <span x-text="q.number"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Grid Part 2: Essay (21 - 25) -->
                <div class="flex flex-col gap-2">
                    <span class="font-sans font-bold text-[#64748B] text-[11px] leading-3.5 uppercase tracking-wider">
                        Bagian 2: Soal Essay (21 - 25)
                    </span>
                    <div class="grid grid-cols-5 gap-2">
                        <template x-for="(q, index) in questions.slice(20, 25)" :key="q.number">
                            <button 
                                type="button"
                                @click="jumpToQuestion(index + 20)"
                                :class="getQuestionClass(q, index + 20)"
                                class="h-9 rounded-lg flex items-center justify-center font-sans text-[13px] transition-all cursor-pointer select-none"
                            >
                                <span x-text="q.number"></span>
                            </button>
                        </template>
                    </div>
                </div>

            </div>

            <!-- Submit Final Button Block -->
            <div class="flex flex-col gap-2 mt-4 pt-2">
                <button 
                    type="button" 
                    @click="showSubmitModal = true"
                    class="w-full h-11 bg-[#147D92] hover:bg-[#0E6273] active:bg-[#0A4D5A] text-white rounded-[10px] px-4 font-sans font-bold text-[13.5px] leading-5 transition-all shadow-[0_4px_12px_rgba(20,125,146,0.2)] text-center cursor-pointer flex items-center justify-center"
                >
                    Kumpulkan Seluruh Jawaban
                </button>
                <span class="font-sans text-[#94A3B8] text-[11px] leading-3.5 text-center">
                    Pastikan semua soal terjawab sebelum submit.
                </span>
            </div>
        </aside>

    </main>

    <!-- Confirmation Modal Submit Ujian -->
    <div 
        x-show="showSubmitModal" 
        x-cloak
        style="display: none;"
        class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-[#0F172A]/80 backdrop-blur-sm transition-opacity"
        @keydown.escape.window="showSubmitModal = false"
    >
        <div 
            @click.away="showSubmitModal = false"
            class="bg-white rounded-[18px] shadow-[0_25px_50px_-12px_rgba(15,23,42,0.35)] border border-[#E2E8F0] max-w-[620px] w-full p-6 sm:p-[36px] flex flex-col gap-[22px] transform transition-all"
        >
            <!-- Modal Header (Icon + Title + Subtitle) -->
            <div class="flex flex-col items-center gap-2.5 text-center">
                <!-- Warning Triangle Badge -->
                <div class="w-[60px] h-[60px] rounded-[18px] bg-[#FEF3C7] border border-[#FDE68A] flex items-center justify-center shrink-0">
                    <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" stroke="#D97706" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="12" y1="9" x2="12" y2="13" stroke="#D97706" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                        <line x1="12" y1="17" x2="12.01" y2="17" stroke="#D97706" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                
                <h3 class="font-sans font-extrabold text-[#0F172A] text-[22px] leading-7 tracking-[-0.02em] m-0">
                    Kumpulkan Jawaban Asesmen?
                </h3>
                <p class="font-sans text-[#64748B] text-[13.5px] leading-5 max-w-[480px] m-0">
                    Pastikan Anda telah memeriksa seluruh jawaban dengan teliti. Setelah dikonfirmasi, pengerjaan tes dinyatakan selesai dan tidak dapat diubah kembali.
                </p>
            </div>

            <!-- Statistics Grid (3 Columns) -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <!-- Soal Terjawab -->
                <div class="bg-[#ECFDF5] border border-[#A7F3D0] rounded-[10px] py-3 px-3.5 flex flex-col items-center gap-0.5">
                    <span class="font-sans font-extrabold text-[#047857] text-[20px] leading-6" x-text="answeredCount">22</span>
                    <span class="font-sans font-semibold text-[#065F46] text-[11px] leading-3.5">Soal Terjawab</span>
                </div>

                <!-- Ragu-ragu -->
                <div class="bg-[#FFFBEB] border border-[#FDE68A] rounded-[10px] py-3 px-3.5 flex flex-col items-center gap-0.5">
                    <span class="font-sans font-extrabold text-[#B45309] text-[20px] leading-6" x-text="doubtfulCount">2</span>
                    <span class="font-sans font-semibold text-[#92400E] text-[11px] leading-3.5">
                        Ragu-ragu <template x-if="doubtfulListText"><span x-text="'(' + doubtfulListText + ')'"></span></template>
                    </span>
                </div>

                <!-- Belum Dijawab -->
                <div class="bg-[#FEF2F2] border border-[#FECACA] rounded-[10px] py-3 px-3.5 flex flex-col items-center gap-0.5">
                    <span class="font-sans font-extrabold text-[#B91C1C] text-[20px] leading-6" x-text="unansweredCount">1</span>
                    <span class="font-sans font-semibold text-[#991B1B] text-[11px] leading-3.5">
                        Belum Dijawab <template x-if="unansweredListText"><span x-text="'(' + unansweredListText + ')'"></span></template>
                    </span>
                </div>
            </div>

            <!-- System Warning Box -->
            <div class="bg-[#FFF7ED] border border-[#FFEDD5] rounded-[10px] py-3.5 px-4 flex items-start gap-3">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 mt-0.5 text-[#EA580C]">
                    <circle cx="12" cy="12" r="10" stroke="#EA580C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="12" y1="8" x2="12" y2="12" stroke="#EA580C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <line x1="12" y1="16" x2="12.01" y2="16" stroke="#EA580C" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="flex flex-col gap-0.5">
                    <span class="font-sans font-bold text-[#9A3412] text-[12.5px] leading-4">
                        Peringatan Sistem
                    </span>
                    <span class="font-sans text-[#C2410C] text-[12px] leading-[18px]">
                        Anda masih memiliki waktu <strong class="font-mono" x-text="timerDisplay">01:14:32</strong>. Disarankan untuk melengkapi <strong x-text="unansweredCount">1</strong> soal yang belum dijawab sebelum mengirimkan tes.
                    </span>
                </div>
            </div>

            <!-- Candidate Info Footer Bar -->
            <div class="bg-[#F8FAFC] border border-[#E2E8F0] rounded-[8px] py-2.5 px-3.5 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0 text-[#64748B]">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="7" r="4" stroke="#64748B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span class="font-sans font-medium text-[#0F172A] text-xs leading-4">
                        Kandidat: Ahmad Fauzi
                    </span>
                </div>
                <span class="font-mono text-[#64748B] text-[11.5px] leading-3.5">
                    Token: VRTA-8921-TK48
                </span>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end gap-3 mt-1.5 flex-wrap">
                <button 
                    type="button" 
                    @click="showSubmitModal = false"
                    class="bg-white border-[1.5px] border-[#CBD5E1] hover:bg-[#F8FAFC] rounded-[10px] py-[11px] px-5 text-[#475569] font-sans font-semibold text-[13.5px] leading-[18px] transition-colors cursor-pointer flex items-center justify-center"
                >
                    ← Periksa Kembali Jawaban
                </button>
                <button 
                    type="button" 
                    @click="submitExam()"
                    class="bg-[#147D92] hover:bg-[#0E6273] active:bg-[#0A4D5A] text-white rounded-[10px] py-[11px] px-6 font-sans font-bold text-[13.5px] leading-[18px] shadow-[0_4px_14px_rgba(20,125,146,0.3)] transition-all cursor-pointer flex items-center gap-2 justify-center"
                >
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Ya, Kumpulkan Sekarang</span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function examApp() {
    return {
        currentIndex: 13, // 0-indexed for Question 14
        showSubmitModal: false,
        totalSeconds: 4472, // 01:14:32 (1*3600 + 14*60 + 32)
        timerDisplay: '01 : 14 : 32',
        lastSavedTime: '15:42',
        
        questions: [
            { number: 1, answered: true, isDoubtful: false, selectedAnswer: 'A', points: 4, category: 'General Backend Architecture', text: 'Konsep dasar skalabilitas horizontal pada microservices?', options: [] },
            { number: 2, answered: true, isDoubtful: false, selectedAnswer: 'C', points: 4, category: 'Database Design', text: 'Teknik normalisasi database relasional 3NF?', options: [] },
            { number: 3, answered: true, isDoubtful: false, selectedAnswer: 'B', points: 4, category: 'API Security', text: 'Metode pengamanan REST API menggunakan JWT dan Token Refresh?', options: [] },
            { number: 4, answered: true, isDoubtful: false, selectedAnswer: 'A', points: 4, category: 'Caching Strategy', text: 'Implementasi Cache-Aside Pattern dengan Redis?', options: [] },
            { number: 5, answered: true, isDoubtful: false, selectedAnswer: 'D', points: 4, category: 'Message Broker', text: 'Perbedaan publish-subscribe pattern vs point-to-point queue?', options: [] },
            { number: 6, answered: true, isDoubtful: false, selectedAnswer: 'B', points: 4, category: 'MySQL Indexing', text: 'Pengaruh Composite Index terhadap query execution plan?', options: [] },
            { number: 7, answered: true, isDoubtful: false, selectedAnswer: 'A', points: 4, category: 'System Architecture', text: 'High Availability dan failover mechanism pada load balancer?', options: [] },
            { number: 8, answered: true, isDoubtful: false, selectedAnswer: 'C', points: 4, category: 'Design Patterns', text: 'Implementasi Repository Pattern dan Dependency Injection?', options: [] },
            { number: 9, answered: true, isDoubtful: false, selectedAnswer: 'B', points: 4, category: 'Distributed Systems', text: 'CAP Theorem dan trade-off consistency vs availability?', options: [] },
            { number: 10, answered: true, isDoubtful: false, selectedAnswer: 'D', points: 4, category: 'Security & Auth', text: 'Pencegahan serangan SQL Injection dan Cross-Site Scripting?', options: [] },
            { number: 11, answered: true, isDoubtful: true, selectedAnswer: 'A', points: 4, category: 'Performance Tuning', text: 'Optimasi query n+1 problem menggunakan eager loading?', options: [] },
            { number: 12, answered: true, isDoubtful: false, selectedAnswer: 'C', points: 4, category: 'Database Replication', text: 'Master-Slave replication lag handling strategy?', options: [] },
            { number: 13, answered: true, isDoubtful: false, selectedAnswer: 'B', points: 4, category: 'Event Driven Architecture', text: 'Idempotency key implementation in financial transactions?', options: [] },
            { 
                number: 14, 
                answered: true, 
                isDoubtful: false, 
                selectedAnswer: 'B', 
                points: 4, 
                category: 'MySQL & Database Concurrency', 
                text: 'Pada arsitektur sistem backend dengan database MySQL InnoDB yang melayani ribuan transaksi pembelian per detik, strategi manakah yang paling efektif untuk mencegah terjadinya Deadlock pada tabel inventaris ketika beberapa transaksi memperbarui stok secara bersamaan?',
                codeSnippet: {
                    filename: 'sql_transaction_snippet.sql',
                    badge: 'InnoDB Transaction Block'
                },
                options: [
                    { id: 'A', text: 'Mengubah Isolation Level transaksi menjadi READ UNCOMMITTED untuk semua kueri write.' },
                    { id: 'B', text: 'Mengunci baris resource dalam urutan yang konsisten (misal urut berdasarkan primary key product_id) dan menggunakan Redis/Queue untuk desensitisasi beban write.' },
                    { id: 'C', text: 'Menonaktifkan indeks foreign key pada tabel transaksi inventaris secara berkala.' },
                    { id: 'D', text: 'Menggunakan LOCK TABLES products WRITE pada awal setiap request HTTP controller.' }
                ]
            },
            { number: 15, answered: true, isDoubtful: false, selectedAnswer: 'A', points: 4, category: 'Cloud Infrastructure', text: 'Auto-scaling policies based on CPU utilization vs request queue depth?', options: [] },
            { number: 16, answered: true, isDoubtful: false, selectedAnswer: 'C', points: 4, category: 'CI/CD & DevOps', text: 'Blue-Green deployment vs Canary release strategy?', options: [] },
            { number: 17, answered: true, isDoubtful: false, selectedAnswer: 'D', points: 4, category: 'Observability', text: 'Distributed tracing implementation with OpenTelemetry?', options: [] },
            { number: 18, answered: true, isDoubtful: false, selectedAnswer: 'B', points: 4, category: 'Rate Limiting', text: 'Token Bucket vs Leaky Bucket algorithm comparison?', options: [] },
            { number: 19, answered: false, isDoubtful: false, selectedAnswer: null, points: 4, category: 'gRPC & Protobuf', text: 'Karakteristik binary serialization protokol gRPC?', options: [] },
            { number: 20, answered: true, isDoubtful: true, selectedAnswer: 'B', points: 4, category: 'Data Consistency', text: 'Two-Phase Commit vs Saga Pattern in microservices?', options: [] },
            // Essay
            { number: 21, answered: true, isDoubtful: false, selectedAnswer: 'filled', points: 10, category: 'System Design Essay', text: 'Rancanglah arsitektur microservices untuk flash sale e-commerce dengan ekspektasi 100k RPM.', options: [] },
            { number: 22, answered: true, isDoubtful: false, selectedAnswer: 'filled', points: 10, category: 'Database Tuning Essay', text: 'Jelaskan tahapan profiling query lambat menggunakan EXPLAIN ANALYZE pada MySQL 8.', options: [] },
            { number: 23, answered: false, isDoubtful: false, selectedAnswer: null, points: 10, category: 'Security Architecture Essay', text: 'Bagaimana mitigasi replay attack dan data tampering pada webhook payment gateway?', options: [] },
            { number: 24, answered: false, isDoubtful: false, selectedAnswer: null, points: 10, category: 'Scalability Essay', text: 'Analisis strategi database sharding vertikal vs horizontal untuk sistem multi-tenant.', options: [] },
            { number: 25, answered: false, isDoubtful: false, selectedAnswer: null, points: 10, category: 'Problem Solving Essay', text: 'Tuliskan pseudo-code algoritma penyelesaian circular dependency pada task scheduler.', options: [] }
        ],

        get currentQuestion() {
            return this.questions[this.currentIndex];
        },

        get answeredCount() {
            return this.questions.filter(q => q.answered).length;
        },

        get doubtfulCount() {
            return this.questions.filter(q => q.isDoubtful).length;
        },

        get unansweredCount() {
            return this.questions.filter(q => !q.answered).length;
        },

        get doubtfulListText() {
            const numbers = this.questions.filter(q => q.isDoubtful).map(q => q.number);
            return numbers.length ? 'No. ' + numbers.join(', ') : '';
        },

        get unansweredListText() {
            const numbers = this.questions.filter(q => !q.answered).map(q => q.number);
            return numbers.length ? 'No. ' + numbers.join(', ') : '';
        },

        get progressPercentage() {
            return Math.round((this.answeredCount / this.questions.length) * 100);
        },

        selectOption(optionId) {
            this.currentQuestion.selectedAnswer = optionId;
            this.currentQuestion.answered = true;
            this.triggerAutosave();
        },

        toggleDoubtful() {
            this.currentQuestion.isDoubtful = !this.currentQuestion.isDoubtful;
        },

        nextQuestion() {
            if (this.currentIndex < this.questions.length - 1) {
                this.currentIndex++;
            }
        },

        prevQuestion() {
            if (this.currentIndex > 0) {
                this.currentIndex--;
            }
        },

        jumpToQuestion(index) {
            this.currentIndex = index;
        },

        getQuestionClass(q, index) {
            const isCurrent = this.currentIndex === index;
            
            if (isCurrent) {
                return 'bg-[#0284C7] border-2 border-[#38BDF8] ring-2 ring-[#0284C7]/40 text-white font-extrabold shadow-sm';
            }
            if (q.isDoubtful) {
                return 'bg-[#F59E0B] text-white font-bold hover:brightness-105';
            }
            if (q.answered) {
                return 'bg-[#10B981] text-white font-bold hover:brightness-105';
            }
            return 'bg-white border-[1.5px] border-[#CBD5E1] text-[#475569] font-semibold hover:border-[#94A3B8] hover:bg-[#F8FAFC]';
        },

        triggerAutosave() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            this.lastSavedTime = `${hours}:${minutes}`;
        },

        initTimer() {
            setInterval(() => {
                if (this.totalSeconds > 0) {
                    this.totalSeconds--;
                    const hours = String(Math.floor(this.totalSeconds / 3600)).padStart(2, '0');
                    const minutes = String(Math.floor((this.totalSeconds % 3600) / 60)).padStart(2, '0');
                    const seconds = String(this.totalSeconds % 60).padStart(2, '0');
                    this.timerDisplay = `${hours} : ${minutes} : ${seconds}`;
                }
            }, 1000);
        },

        submitExam() {
            this.showSubmitModal = false;
            window.location.href = "{{ url('/candidate/completion') }}";
        }
    }
}
</script>
@endpush
@endsection

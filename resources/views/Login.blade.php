<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HR Assessment System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fallback Tailwind untuk development preview jika Vite belum berjalan -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F4F7F9] min-h-screen flex items-center justify-center font-['Inter',system-ui,sans-serif] p-4">

@php
    $lockoutSeconds = session('lockout_seconds', 0);
    if (!$lockoutSeconds && $errors->has('email')) {
        if (preg_match('/dalam (\d+) detik/', $errors->first('email'), $matches)) {
            $lockoutSeconds = (int) $matches[1];
        }
    }
@endphp

<div x-data="loginForm({{ $lockoutSeconds }})" class="w-full max-w-md bg-white rounded-[20px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-solid border-[#DDE6ED] overflow-hidden">
    <!-- Header -->
    <div class="px-8 pt-8 pb-6 flex flex-col items-center">
        <div class="w-14 h-14 bg-[#E2F4F3] rounded-[14px] flex items-center justify-center mb-5">
            <svg width="28" height="28" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                <path d="m9 12 2 2 4-4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h1 class="tracking-[-0.035em] font-[750] text-[#102A43] text-[28px]/9 mb-1 text-center">Masuk ke Sistem</h1>
        <p class="text-[#62798A] text-[15px]/5.5 text-center">HR Assessment Test System</p>
    </div>

    <!-- Form Content -->
    <div class="p-6">
        <!-- Success Message -->
        @if (session('status'))
            <div class="mb-4 px-4 py-3 rounded-[10px] bg-[#E7F6EE] border border-[#BFE5CF] text-[#19734A] text-[13px]">
                {{ session('status') }}
            </div>
        @endif

        <!-- Realtime Lockout Alert -->
        <div x-show="secondsLeft > 0" class="mb-4 px-4 py-3 rounded-[10px] bg-amber-50 border border-amber-200 text-amber-800 text-[13px] flex items-start gap-2.5">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <span class="font-semibold block mb-0.5">Batas Percobaan Login Tercapai</span>
                Coba lagi dalam <span x-text="secondsLeft" class="font-bold text-amber-900"></span> detik kemudian untuk mencoba login kembali.
            </div>
        </div>

        <!-- Lockout Finished Alert -->
        <div x-show="timerFinished" x-cloak class="mb-4 px-4 py-3 rounded-[10px] bg-[#E7F6EE] border border-[#BFE5CF] text-[#19734A] text-[13px] flex items-center gap-2.5">
            <svg class="w-5 h-5 text-[#19734A] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Waktu tunggu telah selesai, silakan coba login kembali.</span>
        </div>

        <!-- Standard Error Message (when not locked out and timer not finished) -->
        @if ($errors->any())
            <div x-show="secondsLeft <= 0 && !timerFinished" class="mb-4 px-4 py-3 rounded-[10px] bg-red-50 border border-red-200 text-red-600 text-[13px]">
                {{ $errors->first('email') }}
            </div>
        @endif

        <!-- Admin Form -->
        <form id="admin-form" action="{{ route('login.submit') }}" method="POST" class="flex flex-col gap-5">
            @csrf
            <div class="flex flex-col gap-2">
                <label for="email" class="font-medium text-[#314E60] text-[13px]">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@company.com" :disabled="secondsLeft > 0" class="px-4 py-3 rounded-[10px] border border-[#DDE6ED] bg-[#F8FAFC] text-[#102A43] text-[15px] focus:outline-none focus:ring-2 focus:ring-[#147D92] focus:border-transparent transition-all disabled:opacity-50 disabled:cursor-not-allowed" required>
            </div>
            <div class="flex flex-col gap-2" x-data="{ showPassword: false }">
                <div class="flex justify-between items-center">
                    <label for="password" class="font-medium text-[#314E60] text-[13px]">Password</label>
                </div>
                <div class="relative flex items-center">
                    <input :type="showPassword ? 'text' : 'password'" id="password" name="password" placeholder="••••••••" :disabled="secondsLeft > 0" class="w-full px-4 py-3 pr-11 rounded-[10px] border border-[#DDE6ED] bg-[#F8FAFC] text-[#102A43] text-[15px] focus:outline-none focus:ring-2 focus:ring-[#147D92] focus:border-transparent transition-all disabled:opacity-50 disabled:cursor-not-allowed" required>
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-[#89A1B3] hover:text-[#314E60] focus:outline-none transition-colors cursor-pointer" aria-label="Toggle password visibility">
                        <!-- Eye icon (show) -->
                        <svg x-show="!showPassword" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <!-- Eye-off icon (hide) -->
                        <svg x-show="showPassword" x-cloak class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" />
                            <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" />
                            <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" />
                            <line x1="2" x2="22" y1="2" y2="22" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex items-center gap-2 mt-1">
                <input type="checkbox" id="remember" name="remember" :disabled="secondsLeft > 0" class="rounded-[4px] border-[#DDE6ED] text-[#147D92] focus:ring-[#147D92] size-4 disabled:opacity-50">
                <label for="remember" class="text-[#62798A] text-[13px]">Ingat Saya</label>
            </div>
            <button type="submit" :disabled="secondsLeft > 0" class="w-full bg-[#147D92] text-white font-semibold text-[15px] py-3.5 rounded-[10px] hover:bg-[#106A7C] transition-colors mt-2 disabled:opacity-50 disabled:cursor-not-allowed">
                <span x-show="secondsLeft > 0">Coba lagi dalam <span x-text="secondsLeft"></span> detik</span>
                <span x-show="secondsLeft <= 0">Login</span>
            </button>
        </form>
    </div>
</div>

<script>
function loginForm(initialSeconds) {
    return {
        secondsLeft: parseInt(initialSeconds) || 0,
        timerFinished: false,
        timerInterval: null,
        init() {
            if (this.secondsLeft > 0) {
                this.startTimer();
            }
        },
        startTimer() {
            this.timerFinished = false;
            if (this.timerInterval) clearInterval(this.timerInterval);
            this.timerInterval = setInterval(() => {
                if (this.secondsLeft > 1) {
                    this.secondsLeft--;
                } else {
                    this.secondsLeft = 0;
                    this.timerFinished = true;
                    clearInterval(this.timerInterval);
                }
            }, 1000);
        }
    };
}
</script>

</body>
</html>

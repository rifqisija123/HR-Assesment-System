<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Buat password untuk mengaktifkan akun Verta Assess Anda.">
    <title>Buat Password - HR Assessment System</title>
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

<div class="w-full max-w-md bg-white rounded-[20px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-solid border-[#DDE6ED] overflow-hidden">
    <!-- Header -->
    <div class="px-8 pt-8 pb-6 flex flex-col items-center">
        <div class="w-14 h-14 bg-[#E2F4F3] rounded-[14px] flex items-center justify-center mb-5">
            <svg width="28" height="28" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <rect x="4" y="11" width="16" height="10" rx="2" fill="none" stroke="#147D92" stroke-width="2" />
                <path d="M8 11V7a4 4 0 0 1 8 0v4" fill="none" stroke="#147D92" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>
        <h1 class="tracking-[-0.035em] font-[750] text-[#102A43] text-[28px]/9 mb-1 text-center">Buat Password</h1>
        <p class="text-[#62798A] text-[15px]/5.5 text-center">
            @if ($valid && $name)
                Halo {{ $name }}, aktifkan akun Anda.
            @else
                HR Assessment Test System
            @endif
        </p>
    </div>

    <div class="p-6 pt-0">
        @if (! $valid)
            <div class="px-4 py-4 rounded-[10px] bg-red-50 border border-red-200 text-red-600 text-[13px]/5 mb-5">
                Link undangan tidak valid atau sudah kedaluwarsa. Silakan hubungi administrator untuk mengirim ulang undangan.
            </div>
            <a href="{{ route('login') }}" id="back-to-login" class="block text-center w-full bg-[#147D92] text-white font-semibold text-[15px] py-3.5 rounded-[10px] hover:bg-[#106A7C] transition-colors">
                Kembali ke Login
            </a>
        @else
            @if ($errors->any())
                <div class="mb-4 px-4 py-3 rounded-[10px] bg-red-50 border border-red-200 text-red-600 text-[13px]">
                    {{ $errors->first() }}
                </div>
            @endif

            <form id="set-password-form" action="{{ route('password.setup.submit') }}" method="POST" class="flex flex-col gap-5"
                  x-data="{ showPwd: false, showConfirm: false, pwd: '', confirm: '' }">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="flex flex-col gap-2">
                    <label class="font-medium text-[#314E60] text-[13px]">Email</label>
                    <input type="email" value="{{ $email }}" disabled class="px-4 py-3 rounded-[10px] border border-[#DDE6ED] bg-[#EEF3F6] text-[#62798A] text-[15px]">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password" class="font-medium text-[#314E60] text-[13px]">Password baru</label>
                    <div class="relative flex items-center">
                        <input :type="showPwd ? 'text' : 'password'" id="password" name="password" x-model="pwd" placeholder="Minimal 8 karakter" required
                               class="w-full px-4 py-3 pr-11 rounded-[10px] border border-[#DDE6ED] bg-[#F8FAFC] text-[#102A43] text-[15px] focus:outline-none focus:ring-2 focus:ring-[#147D92] focus:border-transparent transition-all">
                        <button type="button" @click="showPwd = !showPwd" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-[#89A1B3] hover:text-[#314E60] cursor-pointer" aria-label="Toggle password visibility">
                            <svg x-show="!showPwd" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" /><circle cx="12" cy="12" r="3" /></svg>
                            <svg x-show="showPwd" x-cloak class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" /><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" /><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" /><line x1="2" x2="22" y1="2" y2="22" /></svg>
                        </button>
                    </div>
                    <ul class="flex flex-col gap-1 mt-1 text-[12px]">
                        <li :class="pwd.length >= 8 ? 'text-[#19734A]' : 'text-[#92A4B0]'">• Minimal 8 karakter</li>
                        @if ($enforceStrong)
                            <li :class="/[A-Z]/.test(pwd) && /[a-z]/.test(pwd) ? 'text-[#19734A]' : 'text-[#92A4B0]'">• Mengandung huruf besar & kecil</li>
                            <li :class="/[0-9]/.test(pwd) ? 'text-[#19734A]' : 'text-[#92A4B0]'">• Mengandung angka</li>
                            <li :class="/[^A-Za-z0-9]/.test(pwd) ? 'text-[#19734A]' : 'text-[#92A4B0]'">• Mengandung karakter spesial (!@#$%^&*)</li>
                        @endif
                    </ul>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password_confirmation" class="font-medium text-[#314E60] text-[13px]">Konfirmasi password</label>
                    <div class="relative flex items-center">
                        <input :type="showConfirm ? 'text' : 'password'" id="password_confirmation" name="password_confirmation" x-model="confirm" placeholder="Ulangi password" required
                               class="w-full px-4 py-3 pr-11 rounded-[10px] border border-[#DDE6ED] bg-[#F8FAFC] text-[#102A43] text-[15px] focus:outline-none focus:ring-2 focus:ring-[#147D92] focus:border-transparent transition-all">
                        <button type="button" @click="showConfirm = !showConfirm" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-[#89A1B3] hover:text-[#314E60] cursor-pointer" aria-label="Toggle confirm password visibility">
                            <svg x-show="!showConfirm" class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" /><circle cx="12" cy="12" r="3" /></svg>
                            <svg x-show="showConfirm" x-cloak class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24" /><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68" /><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61" /><line x1="2" x2="22" y1="2" y2="22" /></svg>
                        </button>
                    </div>
                    <p x-show="confirm.length > 0 && confirm !== pwd" x-cloak class="text-[12px] text-red-500">Konfirmasi password tidak cocok.</p>
                </div>

                <button type="submit" id="set-password-submit" class="w-full bg-[#147D92] text-white font-semibold text-[15px] py-3.5 rounded-[10px] hover:bg-[#106A7C] transition-colors mt-2">
                    Simpan Password & Aktifkan Akun
                </button>
            </form>
        @endif
    </div>
</div>

</body>
</html>

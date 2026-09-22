<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HR Assessment System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Fallback Tailwind untuk development preview jika Vite belum berjalan -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
    </style>
</head>
<body class="bg-[#F4F7F9] min-h-screen flex items-center justify-center font-['Inter',system-ui,sans-serif] p-4">

<div class="w-full max-w-md bg-white rounded-[20px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-solid border-[#DDE6ED] overflow-hidden">
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
        <!-- Admin Form -->
        <form id="admin-form" action="#" method="POST" class="flex flex-col gap-5">
            <div class="flex flex-col gap-2">
                <label class="font-medium text-[#314E60] text-[13px]">Email Address</label>
                <input type="email" placeholder="admin@company.com" class="px-4 py-3 rounded-[10px] border border-[#DDE6ED] bg-[#F8FAFC] text-[#102A43] text-[15px] focus:outline-none focus:ring-2 focus:ring-[#147D92] focus:border-transparent transition-all" required>
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <label class="font-medium text-[#314E60] text-[13px]">Password</label>
                    <a href="#" class="text-[#147D92] text-[13px] font-semibold hover:underline">Lupa Password?</a>
                </div>
                <input type="password" placeholder="••••••••" class="px-4 py-3 rounded-[10px] border border-[#DDE6ED] bg-[#F8FAFC] text-[#102A43] text-[15px] focus:outline-none focus:ring-2 focus:ring-[#147D92] focus:border-transparent transition-all" required>
            </div>
            <div class="flex items-center gap-2 mt-1">
                <input type="checkbox" id="remember" class="rounded-[4px] border-[#DDE6ED] text-[#147D92] focus:ring-[#147D92] size-4">
                <label for="remember" class="text-[#62798A] text-[13px]">Ingat Saya</label>
            </div>
            <button type="submit" class="w-full bg-[#147D92] text-white font-semibold text-[15px] py-3.5 rounded-[10px] hover:bg-[#106A7C] transition-colors mt-2">
                Masuk sebagai Admin
            </button>
        </form>

        {{-- <!-- Candidate Form -->
        <form id="candidate-form" action="#" method="POST" class="flex-col gap-5" style="display: none;">
            <div class="flex flex-col gap-2">
                <label class="font-medium text-[#314E60] text-[13px]">Token Assessment</label>
                <input type="text" placeholder="Masukkan token unik" class="px-4 py-3 rounded-[10px] border border-[#DDE6ED] bg-[#F8FAFC] text-[#102A43] text-[15px] focus:outline-none focus:ring-2 focus:ring-[#147D92] focus:border-transparent transition-all uppercase tracking-widest text-center font-bold" required>
                <p class="text-[#62798A] text-[12px] mt-2 text-center">Gunakan token unik yang Anda dapatkan dari undangan email HR.</p>
            </div>
            <button type="submit" class="w-full bg-[#147D92] text-white font-semibold text-[15px] py-3.5 rounded-[10px] hover:bg-[#106A7C] transition-colors mt-2">
                Validasi Token & Mulai
            </button>
        </form> --}}
    </div>
</div>

<script>
    function switchTab(tab) {
        const adminTab = document.getElementById('admin-tab');
        const candidateTab = document.getElementById('candidate-tab');
        const adminForm = document.getElementById('admin-form');
        const candidateForm = document.getElementById('candidate-form');

        if (tab === 'admin') {
            // Update tabs
            adminTab.classList.add('border-[#147D92]', 'text-[#147D92]');
            adminTab.classList.remove('border-transparent', 'text-[#62798A]');
            
            candidateTab.classList.remove('border-[#147D92]', 'text-[#147D92]');
            candidateTab.classList.add('border-transparent', 'text-[#62798A]');
            
            // Show/hide forms
            adminForm.style.display = 'flex';
            candidateForm.style.display = 'none';
        } else {
            // Update tabs
            candidateTab.classList.add('border-[#147D92]', 'text-[#147D92]');
            candidateTab.classList.remove('border-transparent', 'text-[#62798A]');
            
            adminTab.classList.remove('border-[#147D92]', 'text-[#147D92]');
            adminTab.classList.add('border-transparent', 'text-[#62798A]');
            
            // Show/hide forms
            adminForm.style.display = 'none';
            candidateForm.style.display = 'flex';
        }
    }
</script>

</body>
</html>

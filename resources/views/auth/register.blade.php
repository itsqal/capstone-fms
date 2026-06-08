<x-auth.auth-form>
    <x-slot:title>
        Register
    </x-slot:title>
    <div class="w-full">
        <form action="/register" method="POST"
            class="bg-white shadow-[0_10px_50px_rgba(0,0,0,0.03)] rounded-[2rem] px-6 py-8 sm:px-10 sm:py-10 border border-[#F1F5F9]">
            <h1 class="text-2xl sm:text-3xl text-[#170F49] text-center font-bold tracking-tight">
                Buat Akun Baru
            </h1>
            <p class="text-xs sm:text-sm text-center text-[#6F6C90] mt-2 mb-6 leading-relaxed">
                Silahkan isi informasi di bawah ini untuk membuat akun baru.
            </p>
            @csrf

            @if ($errors->any())
                @php
                    $errorMessage = collect($errors->all())->first();
                @endphp
                <div class="mb-4 p-3 rounded-2xl bg-red-50 border border-red-100 text-xs sm:text-sm text-center text-red-600 font-medium">
                    {{ $errorMessage }}
                </div>
            @endif

            <div class="mb-4">
                <label for="name" class="block text-xs sm:text-sm text-[#170F49] font-semibold mb-2 ml-1">Nama</label>
                <input type="text" value="{{ old('name') }}" placeholder="Masukan nama anda" name="name" id="name"
                    class="w-full rounded-full border border-[#EFF0F6] bg-white text-xs sm:text-sm py-3 px-5 sm:py-3.5 sm:px-6 placeholder:text-[#A0A3BD] focus:outline-none focus:border-[#0062FF] focus:ring-4 focus:ring-blue-100 shadow-[0_2px_6px_rgba(19,17,73,0.02)] transition-all duration-200"
                    required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-xs sm:text-sm text-[#170F49] font-semibold mb-2 ml-1">Email</label>
                <input type="email" value="{{ old('email') }}" placeholder="Masukan email anda" name="email" id="email"
                    class="w-full rounded-full border border-[#EFF0F6] bg-white text-xs sm:text-sm py-3 px-5 sm:py-3.5 sm:px-6 placeholder:text-[#A0A3BD] focus:outline-none focus:border-[#0062FF] focus:ring-4 focus:ring-blue-100 shadow-[0_2px_6px_rgba(19,17,73,0.02)] transition-all duration-200"
                    required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-xs sm:text-sm text-[#170F49] font-semibold mb-2 ml-1">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Masukan password anda"
                        class="w-full rounded-full border border-[#EFF0F6] bg-white text-xs sm:text-sm py-3 px-5 sm:py-3.5 sm:px-6 pr-12 sm:pr-14 placeholder:text-[#A0A3BD] focus:outline-none focus:border-[#0062FF] focus:ring-4 focus:ring-blue-100 shadow-[0_2px_6px_rgba(19,17,73,0.02)] transition-all duration-200"
                        required>
                    <span class="absolute right-5 top-1/2 transform -translate-y-1/2 cursor-pointer text-[#A0A3BD] hover:text-[#170F49] transition-colors"
                        onclick="togglePassword('password')">
                        <svg id="eye-open-password" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <svg id="eye-closed-password" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 hidden"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-xs sm:text-sm text-[#170F49] font-semibold mb-2 ml-1">Konfirmasi password</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Masukan ulang password anda"
                        class="w-full rounded-full border border-[#EFF0F6] bg-white text-xs sm:text-sm py-3 px-5 sm:py-3.5 sm:px-6 pr-12 sm:pr-14 placeholder:text-[#A0A3BD] focus:outline-none focus:border-[#0062FF] focus:ring-4 focus:ring-blue-100 shadow-[0_2px_6px_rgba(19,17,73,0.02)] transition-all duration-200"
                        required>
                    <span class="absolute right-5 top-1/2 transform -translate-y-1/2 cursor-pointer text-[#A0A3BD] hover:text-[#170F49] transition-colors"
                        onclick="togglePassword('password_confirmation')">
                        <svg id="eye-open-password_confirmation" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        <svg id="eye-closed-password_confirmation" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5 hidden"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
            </div>

            <button type="submit"
                class="w-full text-sm sm:text-base bg-[#0062FF] hover:bg-[#0056D2] text-white font-bold py-3 sm:py-3.5 rounded-full shadow-[0_8px_24px_rgba(0,98,255,0.25)] transition duration-200 active:scale-[0.98]">
                Register
            </button>

            <div class="flex justify-center mt-6">
                <span class="text-xs sm:text-sm text-[#6F6C90] font-medium">
                    Sudah memiliki akun? <a href="{{ route('login') }}"
                        class="text-[#9747FF] hover:text-[#7F56D9] font-semibold hover:underline ml-1">Login</a>
                </span>
            </div>
        </form>
    </div>

    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            const eyeOpen = document.getElementById('eye-open-' + id);
            const eyeClosed = document.getElementById('eye-closed-' + id);
    
            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
</x-auth.auth-form>
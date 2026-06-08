<x-auth.auth-form>
    <x-slot:title>
        Lupa Password
    </x-slot:title>
    <div class="w-full">
        <form action="{{ route('password.email') }}" method="POST"
            class="bg-white shadow-[0_10px_50px_rgba(0,0,0,0.03)] rounded-[2rem] px-6 py-8 sm:px-10 sm:py-10 border border-[#F1F5F9]">
            <h1 class="text-2xl sm:text-3xl text-[#170F49] text-center font-bold tracking-tight">
                Lupa Password
            </h1>
            <p class="text-xs sm:text-sm text-center text-[#6F6C90] mt-2 mb-6 leading-relaxed">
                Silahkan masukan akun email anda untuk mendapatkan email konfirmasi reset password.
            </p>
            @csrf

            @if (session('status'))
                <div class="mb-4 p-3 rounded-2xl bg-green-50 border border-green-100 text-xs sm:text-sm text-center text-green-700 font-medium">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                @php
                    $errorMessage = collect($errors->all())->first();
                @endphp
                <div class="mb-4 p-3 rounded-2xl bg-red-50 border border-red-100 text-xs sm:text-sm text-center text-red-600 font-medium">
                    {{ $errorMessage }}
                </div>
            @endif

            <div class="mb-6">
                <label for="email" class="block text-xs sm:text-sm text-[#170F49] font-semibold mb-2 ml-1">Email</label>
                <input type="email" value="{{ old('email') }}" placeholder="Masukan email anda" name="email" id="email"
                    class="w-full rounded-full border border-[#EFF0F6] bg-white text-xs sm:text-sm py-3 px-5 sm:py-3.5 sm:px-6 placeholder:text-[#A0A3BD] focus:outline-none focus:border-[#0062FF] focus:ring-4 focus:ring-blue-100 shadow-[0_2px_6px_rgba(19,17,73,0.02)] transition-all duration-200"
                    required>
            </div>

            <button type="submit"
                class="w-full text-sm sm:text-base bg-[#0062FF] hover:bg-[#0056D2] text-white font-bold py-3 sm:py-3.5 rounded-full shadow-[0_8px_24px_rgba(0,98,255,0.25)] transition duration-200 active:scale-[0.98]">
                Kirim
            </button>

            <div class="flex justify-center mt-6">
                <span class="text-xs sm:text-sm text-[#6F6C90] font-medium">
                    Kembali ke <a href="{{ route('login') }}"
                        class="text-[#9747FF] hover:text-[#7F56D9] font-semibold hover:underline ml-1">Login</a>
                </span>
            </div>
        </form>
    </div>
</x-auth.auth-form>
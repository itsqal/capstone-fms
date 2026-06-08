<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('favlogo.ico')}}" type="image/x-icon">
</head>

<body class="min-h-screen font-sans bg-[#F8FAFC]">
    <div class="min-h-screen w-full flex items-center justify-center relative overflow-hidden p-4 sm:p-6 md:p-8">
        <!-- Soft glowing gradient spheres in the background -->
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] rounded-full bg-[#E0E7FF] opacity-60 blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-[#F3E8FF] opacity-70 blur-[120px] pointer-events-none"></div>
        <div class="absolute top-[30%] right-[-10%] w-[35%] h-[35%] rounded-full bg-[#E0F2FE] opacity-50 blur-[100px] pointer-events-none"></div>

        <!-- Form Container -->
        <div class="relative w-full max-w-[480px] z-10">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
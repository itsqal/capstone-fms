<div x-data="{ open: false }" class="relative z-50">
    <!-- Backdrop Overlay -->
    <div x-show="open" @click="$dispatch('toggle')"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-slate-950/20 backdrop-blur-[2px] z-40">
    </div>

    <!-- Sidebar -->
    <aside x-show="open" x-on:toggle.window="open = !open"
        x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-300"
        x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
        class="bg-white h-full fixed inset-y-0 left-0 flex flex-col justify-between transition-all duration-300 overflow-visible shadow-[8px_0_30px_rgba(0,0,0,0.04)] rounded-r-[32px] w-[280px] z-50">

        <!-- Floating Close Button -->
        <button @click="$dispatch('toggle')"
            class="absolute top-[38px] -right-3.5 w-7 h-7 rounded-full bg-white border border-gray-100 shadow-md flex items-center justify-center cursor-pointer hover:bg-gray-50 hover:scale-105 active:scale-95 transition-all duration-200 z-50 focus:outline-none">
            <svg class="w-3.5 h-3.5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>

        <!-- Inner Content Area -->
        <div class="flex flex-col justify-between h-full py-8 px-6 overflow-y-auto">
            <div>
                <!-- Brand Header -->
                <div class="flex items-center gap-3 mb-10 px-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-10">
                    <h2 class="text-[22px] font-sans text-[#1E293B] font-bold tracking-tight">Tracktion</h2>
                </div>
            
                <!-- Navigation Items -->
                <nav class="flex flex-col gap-2">
                    <!-- Dashboard -->
                    <x-nav-link href="{{ route('dashboard.index') }}" :active="request()->routeIs('dashboard.index')">
                        <svg class="w-5 h-5 text-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
                        </svg>
                        Dashboard
                    </x-nav-link>

                    <!-- Penugasan -->
                    <x-nav-link href="#" :active="false">
                        <svg class="w-5 h-5 text-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <path d="m9 15 2 2 4-4"></path>
                        </svg>
                        Penugasan
                    </x-nav-link>
        
                    <!-- Pengiriman -->
                    <x-nav-link href="{{ route('shipments.index') }}" :active="request()->is('shipments*')">
                        <svg class="w-5 h-5 text-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        Pengiriman
                    </x-nav-link>
        
                    <!-- Truk -->
                    <x-nav-link href="{{ route('trucks.index') }}" :active="request()->is('trucks*')">
                        <svg class="w-5 h-5 text-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13" rx="2" ry="2"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                        Truk
                    </x-nav-link>
        
                    <!-- Sopir -->
                    <x-nav-link href="{{ route('drivers.index') }}" :active="request()->is('drivers*')">
                        <svg class="w-5 h-5 text-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Sopir
                    </x-nav-link>
        
                    <!-- Laporan Kendala -->
                    <x-nav-link href="{{ route('reports.index') }}" :active="request()->is('reports*')">
                        <svg class="w-5 h-5 text-current" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22v-4"></path>
                            <path d="M4 12V4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2z"></path>
                            <path d="M12 6v4"></path>
                            <path d="M8 8v2"></path>
                            <path d="M16 7v3"></path>
                        </svg>
                        Laporan Kendala
                    </x-nav-link>
                </nav>
            </div>
        
            <!-- Bottom Footer Area -->
            <div class="mt-auto pt-6 border-t border-slate-100 px-2">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="group flex items-center gap-4 w-full px-4 py-3 text-[15px] font-semibold text-red-600 rounded-xl hover:bg-red-50 hover:text-red-700 transition duration-200 cursor-pointer">
                        <svg class="w-5 h-5 text-current transition duration-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>
</div>
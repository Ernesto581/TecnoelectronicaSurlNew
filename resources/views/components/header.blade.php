@props(['solid' => false])

@php
    $heroPages = ['/', 'quienes-somos', 'servicio-domicilio', 'tienda', 'servicios'];
    $isHero = in_array(request()->path(), $heroPages);
    $isScrolled = $solid || !$isHero;
@endphp

<header
    x-data="{ mobileOpen: false, scrolled: {{ $isScrolled ? 'true' : 'false' }}, cartCount: 0, searchOpen: false, searchQuery: '' }"
    x-init="if (!{{ $isScrolled ? 'true' : 'false' }}) {
        window.addEventListener('scroll', () => { scrolled = window.scrollY > 10; });
    }"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm h-20 border-b border-gray-200' : 'bg-transparent h-24 border-b border-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="h-full px-4 md:px-8 max-w-[1600px] mx-auto flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 group z-50">
            <img src="/logo.png" alt="Tecnoelectronica" class="h-14 w-auto object-contain" />
            <div class="flex flex-col leading-tight">
                <span :class="scrolled ? 'text-black' : 'text-white'" class="text-lg font-bold tracking-tight">
                    <span :class="scrolled ? 'text-black' : 'text-white'">Tecnoelectronica</span>
                    <span class="text-[#46A040]">SURL</span>
                </span>
                <span :class="scrolled ? 'text-gray-500' : 'text-white/70'" class="text-[11px] font-medium leading-none">
                    Creatividad y suministros a su alcance
                </span>
            </div>
        </a>

        <nav class="hidden xl:flex items-center gap-8">
            <a href="/" :class="scrolled ? 'text-gray-600 hover:text-[#46A040]' : 'text-white/80 hover:text-white'" class="text-sm font-medium transition-colors cursor-pointer">Inicio</a>
            <a href="/quienes-somos" :class="scrolled ? 'text-gray-600 hover:text-[#46A040]' : 'text-white/80 hover:text-white'" class="text-sm font-medium transition-colors cursor-pointer">Quiénes Somos</a>
            <a href="/tienda" :class="scrolled ? 'text-gray-600 hover:text-[#46A040]' : 'text-white/80 hover:text-white'" class="text-sm font-medium transition-colors cursor-pointer">Tienda</a>
            <a href="/servicio-domicilio" :class="scrolled ? 'text-gray-600 hover:text-[#46A040]' : 'text-white/80 hover:text-white'" class="text-sm font-medium transition-colors cursor-pointer">Servicio a Domicilio</a>
        </nav>

        <div class="hidden md:flex items-center gap-4">
            @if(request()->path() !== 'tienda')
            <div class="relative">
                <template x-if="!searchOpen">
                    <button @click="searchOpen = true; $nextTick(() => $refs.searchInput.focus())" :class="scrolled ? 'text-gray-600 hover:text-[#46A040] hover:bg-gray-100' : 'text-white/80 hover:text-white hover:bg-white/10'" class="p-2 transition-colors rounded-full">
                        <x-icon name="search" class="w-5 h-5" />
                    </button>
                </template>
                <template x-if="searchOpen">
                    <form action="/tienda" method="GET" class="flex items-center gap-2">
                        <input x-ref="searchInput" x-model="searchQuery" type="text" name="q" placeholder="Buscar productos..." :class="scrolled ? 'border-gray-300 bg-white text-gray-900' : 'border-white/30 bg-white/10 text-white placeholder:text-white/60'" class="w-56 px-4 py-2 rounded-full border text-sm outline-none focus:ring-2 focus:ring-[#46A040]" />
                        <button type="submit" :class="scrolled ? 'text-gray-600' : 'text-white/80'" class="p-2 hover:text-[#46A040] transition-colors rounded-full">
                            <x-icon name="search" class="w-5 h-5" />
                        </button>
                        <button type="button" @click="searchOpen = false; searchQuery = ''" :class="scrolled ? 'text-gray-400' : 'text-white/60'" class="p-2 hover:text-gray-600 transition-colors rounded-full">
                            <x-icon name="x" class="w-4 h-4" />
                        </button>
                    </form>
                </template>
            </div>
            @endif
            <button :class="scrolled ? 'text-gray-600 hover:text-[#46A040] hover:bg-gray-100' : 'text-white/80 hover:text-white hover:bg-white/10'" class="p-2 transition-colors rounded-full relative">
                <x-icon name="shopping-cart" class="w-5 h-5" />
                <template x-if="cartCount > 0">
                    <span class="absolute -top-0.5 -right-0.5 min-w-[18px] h-[18px] bg-[#46A040] text-white text-[10px] font-bold rounded-full flex items-center justify-center px-1 shadow-lg" x-text="cartCount > 99 ? '99+' : cartCount"></span>
                </template>
            </button>
            @auth
                <a href="{{ route('profile.edit') }}" :class="scrolled ? 'text-[#46A040] bg-[#ecf8ef] hover:bg-[#d2efdc]' : 'text-white/90 bg-white/10 hover:bg-white/20'" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-full transition-all cursor-pointer">
                    <x-icon name="user" class="w-4 h-4" />
                    Cuenta
                </a>
            @else
                <a href="{{ route('login') }}" :class="scrolled ? 'text-[#46A040] bg-[#ecf8ef] hover:bg-[#d2efdc]' : 'text-white/90 bg-white/10 hover:bg-white/20'" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-full transition-all cursor-pointer">
                    <x-icon name="log-in" class="w-4 h-4" />
                    Cuenta
                </a>
            @endauth
            <a href="#contacto" :class="scrolled ? 'bg-[#46A040] text-white hover:bg-[#3d8c38] shadow-[#46A040]/20' : 'bg-white text-gray-900 hover:bg-gray-100 shadow-black/10'" class="ml-2 px-6 py-2.5 text-sm font-bold rounded-full transition-all shadow-lg">
                Contáctenos
            </a>
        </div>

        <div class="flex xl:hidden items-center gap-2 z-50">
            <button @click="mobileOpen = false" :class="mobileOpen ? 'text-gray-800' : scrolled ? 'text-gray-800' : 'text-white'" class="md:hidden p-2 transition-colors relative">
                <x-icon name="shopping-cart" class="w-5 h-5" />
            </button>
            <button @click="mobileOpen = !mobileOpen" :class="mobileOpen ? 'border-gray-200 text-gray-800 bg-white' : scrolled ? 'border-gray-200 text-gray-800 bg-white' : 'border-white/20 text-white bg-white/10 backdrop-blur-md'" class="p-2 rounded-md border transition-colors">
                <template x-if="mobileOpen">
                    <x-icon name="x" class="w-5 h-5" />
                </template>
                <template x-if="!mobileOpen">
                    <x-icon name="menu" class="w-5 h-5" />
                </template>
            </button>
        </div>

        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="absolute top-full left-0 w-full bg-white shadow-xl xl:hidden border-b border-gray-200 flex flex-col" style="display: none;">
            @if(request()->path() !== 'tienda')
            <form action="/tienda" method="GET" class="p-4 border-b border-gray-100 bg-gray-50 flex items-center">
                <x-icon name="search" class="w-5 h-5 text-gray-400 mr-2 shrink-0" />
                <input type="text" name="q" placeholder="Buscar productos..." class="bg-transparent border-none outline-none w-full text-sm text-gray-800 focus:ring-0" />
            </form>
            @endif
            <div class="flex flex-col py-2">
                <a href="/" @click="mobileOpen = false" class="px-6 py-4 text-base font-medium text-gray-800 hover:bg-gray-50 hover:text-[#46A040] transition-colors border-b border-gray-100">Inicio</a>
                <a href="/quienes-somos" @click="mobileOpen = false" class="px-6 py-4 text-base font-medium text-gray-800 hover:bg-gray-50 hover:text-[#46A040] transition-colors border-b border-gray-100">Quiénes Somos</a>
                <a href="/tienda" @click="mobileOpen = false" class="px-6 py-4 text-base font-medium text-gray-800 hover:bg-gray-50 hover:text-[#46A040] transition-colors border-b border-gray-100">Tienda</a>
                <a href="/servicio-domicilio" @click="mobileOpen = false" class="px-6 py-4 text-base font-medium text-gray-800 hover:bg-gray-50 hover:text-[#46A040] transition-colors border-b border-gray-100">Servicio a Domicilio</a>
            </div>
            <div class="p-6 bg-gray-50 border-t border-gray-100">
                <a href="#contacto" @click="mobileOpen = false" class="block w-full text-center px-6 py-3.5 bg-[#46A040] text-white font-bold rounded-md">Contáctenos</a>
            </div>
        </div>
    </div>
</header>

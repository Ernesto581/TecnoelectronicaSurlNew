@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen bg-surface">
    <div class="relative pt-32 pb-20 bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/10 text-white/80 text-xs font-mono font-bold uppercase tracking-[0.15em] rounded-full border border-white/10 mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-[#46A040]"></span>
                Servicios
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white tracking-tight mb-6 leading-tight">
                Desarrollo de <span class="text-[#46A040]">Software</span>
            </h1>
            <p class="text-lg text-gray-300 max-w-xl mx-auto leading-relaxed mb-10">Estamos preparando esta secci&oacute;n. Pronto encontrar&aacute;s aqu&iacute; toda la informaci&oacute;n sobre nuestros servicios de desarrollo.</p>
            <a href="/" class="inline-flex items-center gap-2 px-8 py-4 bg-[#46A040] text-white font-bold rounded-full hover:bg-[#3d8c38] transition-colors shadow-lg shadow-[#46A040]/30">
                <x-icon name="home" class="w-5 h-5" />
                Volver al inicio
            </a>
        </div>
    </div>

    <div class="flex-1 flex items-center justify-center py-20">
        <div class="text-center max-w-md mx-auto px-4">
            <div class="w-20 h-20 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mx-auto mb-6">
                <x-icon name="wrench" class="w-10 h-10 text-[#46A040]" />
            </div>
            <h2 class="text-2xl font-display font-bold text-gray-900 mb-3">P&aacute;gina en mantenimiento</h2>
            <p class="text-gray-500 mb-8 leading-relaxed">Estamos trabajando en esta secci&oacute;n para ofrecerte la mejor experiencia. Vuelve pronto.</p>
            <a href="https://wa.me/5350994365" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-[#46A040] text-white font-semibold rounded-xl hover:bg-[#3d8c38] transition-colors">
                <x-icon name="message-circle" class="w-5 h-5" />
                Consultar por WhatsApp
            </a>
        </div>
    </div>
</div>
@endsection

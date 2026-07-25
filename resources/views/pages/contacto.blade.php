@extends('layouts.app')

@section('content')
<div class="flex flex-col">
    {{-- HERO --}}
    <div class="relative pt-32 pb-20 bg-gray-900 overflow-hidden">
        <img src="https://picsum.photos/seed/contacto/1920/600" alt="Contacto" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40" />
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
            <span class="inline-flex items-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 px-5 py-2 text-sm text-white tracking-widest uppercase mb-6 shadow-lg">
                Atención al Cliente
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white tracking-tight mb-6">
                Estamos aquí para <span class="text-[#46A040]">ayudarte</span>
            </h1>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Encuéntranos en nuestro local comercial, escríbenos por WhatsApp o envíanos un mensaje directo. Te responderemos al instante.
            </p>
        </div>
    </div>

    {{-- INFORMACIÓN DE CONTACTO + FORMULARIO --}}
    <section class="py-24 bg-white">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="grid lg:grid-cols-12 gap-10 items-start">
                {{-- COLUMNA IZQUIERDA: Tarjetas de Información --}}
                <div class="lg:col-span-5 space-y-5">
                    <div class="group bg-white rounded-3xl p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-xl hover:border-[#46A040]/30 transition-all duration-300 flex items-start gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="map-pin" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Dirección Física</h3>
                            <p class="text-gray-500 leading-relaxed text-sm">Calle Cuba, No. 367, Sur, entre Carretera Central y Serafín Sánchez,<br />Santa Clara, Villa Clara.</p>
                        </div>
                    </div>

                    <div class="group bg-white rounded-3xl p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-xl hover:border-[#46A040]/30 transition-all duration-300 flex items-start gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="mail" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Correo Electrónico</h3>
                            <a href="mailto:tecnoelectronicasurl@gmail.com" class="text-gray-500 hover:text-[#46A040] transition-colors text-sm font-medium break-all">
                                tecnoelectronicasurl@gmail.com
                            </a>
                        </div>
                    </div>

                    <div class="group bg-white rounded-3xl p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-xl hover:border-[#46A040]/30 transition-all duration-300 flex items-start gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="message-circle" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div class="w-full">
                            <h3 class="text-lg font-bold text-gray-900 mb-3">Líneas de WhatsApp</h3>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <div>
                                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Ventas y Atención</span>
                                        <a href="https://wa.me/5350994365" target="_blank" class="text-[#46A040] font-bold hover:underline">+53 50994365</a>
                                    </div>
                                    <x-icon name="phone" class="w-5 h-5 text-gray-300" />
                                </div>
                                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <div>
                                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-0.5">Soporte Técnico</span>
                                        <a href="https://wa.me/5350927120" target="_blank" class="text-[#46A040] font-bold hover:underline">+53 50927120</a>
                                    </div>
                                    <x-icon name="wrench" class="w-5 h-5 text-gray-300" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="group bg-white rounded-3xl p-7 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-xl hover:border-[#46A040]/30 transition-all duration-300 flex items-start gap-5">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform duration-300">
                            <x-icon name="clock" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Horario de Atención</h3>
                            <div class="flex justify-between items-center text-sm mb-1">
                                <span class="text-gray-500">Lunes a Viernes</span>
                                <span class="font-bold text-gray-800">8:00 AM – 7:00 PM</span>
                            </div>
                            <div class="w-full h-px bg-gray-100 my-2"></div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">Sábados</span>
                                <span class="font-bold text-gray-800">8:00 AM – 2:00 PM</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- COLUMNA DERECHA: Formulario --}}
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-[32px] p-8 md:p-12 shadow-2xl shadow-gray-200/50 border border-gray-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-[#46A040]/5 rounded-full blur-[80px] pointer-events-none"></div>
                        <div class="relative z-10">
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Envíanos un mensaje</h2>
                            <p class="text-gray-500 mb-8">Completa el formulario y nuestro equipo te contactará a la brevedad.</p>

                            <form action="#" method="POST" class="space-y-6">
                                @csrf
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label class="text-sm font-bold text-gray-700">Nombre completo</label>
                                        <input type="text" name="name" required placeholder="Ej. Juan Pérez" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-gray-700" />
                                    </div>
                                    <div class="space-y-2">
                                        <label class="text-sm font-bold text-gray-700">Teléfono / Celular</label>
                                        <input type="tel" name="phone" placeholder="+53 50000000" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-gray-700" />
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700">Correo electrónico</label>
                                    <input type="email" name="email" required placeholder="correo@ejemplo.com" class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-gray-700" />
                                </div>

                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-gray-700">Mensaje o consulta</label>
                                    <textarea name="message" rows="4" required placeholder="¿En qué podemos ayudarte?..." class="w-full px-5 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-gray-700 resize-none"></textarea>
                                </div>

                                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#46A040] hover:bg-[#388233] text-white font-bold text-lg py-4 rounded-xl shadow-lg shadow-[#46A040]/30 transition-all hover:-translate-y-0.5 active:scale-[0.98]">
                                    Enviar Mensaje
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MAPA --}}
    <section class="py-24 bg-gray-50">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <span class="text-[#46A040] uppercase tracking-[4px] font-bold text-sm block mb-2">Ubicación</span>
                    <h2 class="text-3xl font-bold text-gray-900">Nuestra Sede Comercial</h2>
                </div>
                <a href="https://maps.google.com/?q=22.4064,-79.9647" target="_blank" class="inline-flex items-center gap-2 bg-white border-2 border-gray-200 text-gray-700 px-6 py-3 rounded-full font-bold hover:border-[#46A040] hover:text-[#46A040] transition-colors">
                    <x-icon name="map" class="w-5 h-5" />
                    Abrir en Google Maps
                </a>
            </div>

            <div class="relative rounded-[32px] overflow-hidden shadow-2xl border border-gray-200 h-[500px] bg-gray-100 group">
                <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=-79.975%2C22.395%2C-79.955%2C22.415&amp;layer=transport&amp;marker=22.4064%2C-79.9647" class="w-full h-full grayscale-[0.2] contrast-125 group-hover:grayscale-0 transition-all duration-700" style="border:0;" allowfullscreen loading="lazy" title="Ubicación Tecnoelectronica SURL"></iframe>
            </div>
        </div>
    </section>
</div>
@endsection

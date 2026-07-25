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
    <section class="py-24 bg-gray-50/50">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="grid lg:grid-cols-12 gap-8 items-stretch">
                
                {{-- COLUMNA IZQUIERDA: Panel Integrado --}}
                <div class="lg:col-span-5 bg-white rounded-[32px] p-8 md:p-10 shadow-xl shadow-gray-200/60 border border-gray-100/80 flex flex-col justify-between">
                    <div>
                        <div class="mb-8">
                            <span class="text-[#46A040] uppercase tracking-wider font-bold text-xs block mb-1">Contacto Directo</span>
                            <h2 class="text-2xl font-bold text-gray-900">Información de contacto</h2>
                        </div>

                        <div class="space-y-6">
                            {{-- Dirección --}}
                            <div class="flex items-start gap-4 p-2 -mx-2 rounded-2xl hover:bg-gray-50 transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                    <x-icon name="map-pin" class="w-6 h-6 text-[#46A040]" />
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-gray-900">Dirección Física</h3>
                                    <p class="text-gray-500 text-sm leading-relaxed mt-0.5">Calle Cuba, No. 367, Sur, entre Carretera Central y Serafín Sánchez, Santa Clara, Villa Clara.</p>
                                </div>
                            </div>

                            <div class="w-full h-px bg-gray-100"></div>

                            {{-- Email --}}
                            <div class="flex items-start gap-4 p-2 -mx-2 rounded-2xl hover:bg-gray-50 transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                    <x-icon name="mail" class="w-6 h-6 text-[#46A040]" />
                                </div>
                                <div>
                                    <h3 class="text-sm font-bold text-gray-900">Correo Electrónico</h3>
                                    <a href="mailto:tecnoelectronicasurl@gmail.com" class="text-gray-600 hover:text-[#46A040] transition-colors text-sm font-medium break-all block mt-0.5">
                                        tecnoelectronicasurl@gmail.com
                                    </a>
                                </div>
                            </div>

                            <div class="w-full h-px bg-gray-100"></div>

                            {{-- WhatsApp --}}
                            <div class="flex items-start gap-4 p-2 -mx-2 rounded-2xl hover:bg-gray-50 transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                    <x-icon name="message-circle" class="w-6 h-6 text-[#46A040]" />
                                </div>
                                <div class="w-full">
                                    <h3 class="text-sm font-bold text-gray-900 mb-3">Líneas de WhatsApp</h3>
                                    <div class="space-y-2.5">
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-500">Ventas y Atención</span>
                                            <a href="https://wa.me/5350994365" target="_blank" class="text-[#46A040] font-bold hover:underline flex items-center gap-1.5">
                                                +53 50994365
                                                <x-icon name="phone" class="w-3.5 h-3.5" />
                                            </a>
                                        </div>
                                        <div class="flex items-center justify-between text-sm">
                                            <span class="text-gray-500">Soporte Técnico</span>
                                            <a href="https://wa.me/5350927120" target="_blank" class="text-[#46A040] font-bold hover:underline flex items-center gap-1.5">
                                                +53 50927120
                                                <x-icon name="wrench" class="w-3.5 h-3.5" />
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full h-px bg-gray-100"></div>

                            {{-- Horarios --}}
                            <div class="flex items-start gap-4 p-2 -mx-2 rounded-2xl hover:bg-gray-50 transition-colors">
                                <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                    <x-icon name="clock" class="w-6 h-6 text-[#46A040]" />
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold text-gray-900 mb-2">Horario de Atención</h3>
                                    <div class="space-y-1.5 text-sm">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500">Lunes a Viernes</span>
                                            <span class="font-bold text-gray-800">8:00 AM – 7:00 PM</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-500">Sábados</span>
                                            <span class="font-bold text-gray-800">8:00 AM – 2:00 PM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- COLUMNA DERECHA: Formulario en Caja Identica --}}
                <div class="lg:col-span-7 bg-white rounded-[32px] p-8 md:p-10 shadow-xl shadow-gray-200/60 border border-gray-100/80 relative overflow-hidden flex flex-col justify-between">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-[#46A040]/5 rounded-full blur-[80px] pointer-events-none"></div>
                    <div class="relative z-10">
                        <div class="mb-8">
                            <span class="text-[#46A040] uppercase tracking-wider font-bold text-xs block mb-1">Escríbenos</span>
                            <h2 class="text-2xl font-bold text-gray-900">Envíanos un mensaje</h2>
                            <p class="text-gray-500 text-sm mt-1">Completa el formulario y nuestro equipo te contactará a la brevedad.</p>
                        </div>

                        <form action="#" method="POST" class="space-y-5">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-5">
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Nombre completo</label>
                                    <input type="text" name="name" required placeholder="Ej. Juan Pérez" class="w-full px-4 py-3 bg-gray-50 border border-gray-200/80 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-sm text-gray-700" />
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Teléfono / Celular</label>
                                    <input type="tel" name="phone" placeholder="+53 50000000" class="w-full px-4 py-3 bg-gray-50 border border-gray-200/80 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-sm text-gray-700" />
                                </div>
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Correo electrónico</label>
                                <input type="email" name="email" required placeholder="correo@ejemplo.com" class="w-full px-4 py-3 bg-gray-50 border border-gray-200/80 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-sm text-gray-700" />
                            </div>

                            <div class="space-y-1.5">
                                <label class="text-xs font-bold text-gray-700 uppercase tracking-wider">Mensaje o consulta</label>
                                <textarea name="message" rows="4" required placeholder="¿En qué podemos ayudarte?..." class="w-full px-4 py-3 bg-gray-50 border border-gray-200/80 rounded-xl focus:bg-white focus:ring-4 focus:ring-[#46A040]/15 focus:border-[#46A040] outline-none transition-all text-sm text-gray-700 resize-none"></textarea>
                            </div>

                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-[#46A040] hover:bg-[#388233] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-[#46A040]/25 transition-all hover:-translate-y-0.5 active:scale-[0.98]">
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
    </section>

    {{-- MAPA --}}
    <section class="py-24 bg-white">
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
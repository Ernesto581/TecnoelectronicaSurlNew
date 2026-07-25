@extends('layouts.app')

@section('content')
<div class="flex flex-col">
    {{-- HERO --}}
    <section class="relative overflow-hidden pt-36 pb-40">
        <img src="{{ asset('images/contacto.webp') }}" alt="Contacto" class="absolute inset-0 w-full h-full object-cover" />
        <div class="absolute inset-0 bg-gradient-to-r from-gray-950/95 via-gray-900/85 to-gray-900/60"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,rgba(70,160,64,.25),transparent_40%)]"></div>
        <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8">
            <span class="inline-flex items-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 px-5 py-2 text-sm text-white tracking-widest uppercase">
                Contacto
            </span>
            <h1 class="mt-8 text-5xl lg:text-7xl font-display font-bold text-white leading-tight">
                Estamos listos para
                <span class="text-[#46A040]">ayudarte</span>
            </h1>
            <p class="mt-8 max-w-2xl text-xl text-gray-300 leading-relaxed">
                Nuestro equipo está disponible para asesorarte, responder tus dudas
                y ofrecerte soluciones tecnológicas de forma rápida y profesional.
            </p>
            <div class="mt-12 flex flex-wrap gap-5">
                <a href="https://wa.me/5350994365" target="_blank" class="bg-[#46A040] hover:bg-[#3b9036] text-white rounded-full px-8 py-4 font-semibold transition-all hover:scale-105 shadow-xl">
                    <x-icon name="message-circle" class="w-5 h-5 inline-block mr-2" />
                    WhatsApp
                </a>
                <a href="mailto:tecnoelectronicasurl@gmail.com" class="bg-white/10 backdrop-blur-md border border-white/20 hover:bg-white/20 text-white rounded-full px-8 py-4 transition-all">
                    <x-icon name="mail" class="w-5 h-5 inline-block mr-2" />
                    Enviar Email
                </a>
            </div>
        </div>

        {{-- TARJETA FLOTANTE --}}
        <div class="absolute left-1/2 -translate-x-1/2 bottom-0 translate-y-1/2 w-full max-w-6xl px-4">
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 p-8">
                <div class="grid md:grid-cols-4 gap-8">
                    <div class="flex gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="map-pin" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Dirección</p>
                            <p class="text-gray-500 text-sm mt-2">Santa Clara</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="mail" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Email</p>
                            <p class="text-gray-500 text-sm mt-2 break-all">tecnoelectronicasurl@gmail.com</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="message-circle" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">WhatsApp</p>
                            <p class="text-gray-500 text-sm mt-2">+53 50994365</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="clock" class="w-7 h-7 text-[#46A040]" />
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Horario</p>
                            <p class="text-gray-500 text-sm mt-2">Lun – Vie 8AM–7PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- INFORMACIÓN --}}
    <section class="bg-gray-50 pt-44 pb-24">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-20">
                <span class="text-[#46A040] uppercase tracking-[5px] font-semibold">Información</span>
                <h2 class="mt-4 text-4xl font-bold text-gray-900">Todas nuestras vías de contacto</h2>
            </div>
            <div class="grid lg:grid-cols-2 gap-8">
                {{-- COLUMNA IZQUIERDA --}}
                <div class="grid sm:grid-cols-2 gap-6">
                    <div class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mb-6 group-hover:scale-110 transition">
                            <x-icon name="map-pin" class="w-8 h-8 text-[#46A040]" />
                        </div>
                        <h3 class="font-bold text-xl text-gray-900 mb-4">Dirección</h3>
                        <p class="text-gray-600 leading-7">
                            Calle Cuba No. 367 Sur entre Carretera Central y Serafín Sánchez, Santa Clara, Villa Clara.
                        </p>
                    </div>
                    <div class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mb-6 group-hover:scale-110 transition">
                            <x-icon name="mail" class="w-8 h-8 text-[#46A040]" />
                        </div>
                        <h3 class="font-bold text-xl text-gray-900 mb-4">Correo</h3>
                        <a href="mailto:tecnoelectronicasurl@gmail.com" class="text-[#46A040] font-semibold hover:underline break-all">
                            tecnoelectronicasurl@gmail.com
                        </a>
                    </div>
                    <div class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mb-6 group-hover:scale-110 transition">
                            <x-icon name="message-circle" class="w-8 h-8 text-[#46A040]" />
                        </div>
                        <h3 class="font-bold text-xl text-gray-900 mb-4">WhatsApp</h3>
                        <a href="https://wa.me/5350994365" target="_blank" class="text-[#46A040] font-semibold">+53 50994365</a>
                        <p class="text-gray-500 mt-4 text-sm">Atención inmediata.</p>
                    </div>
                    <div class="group bg-white rounded-3xl p-8 shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
                        <div class="w-16 h-16 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mb-6 group-hover:scale-110 transition">
                            <x-icon name="clock" class="w-8 h-8 text-[#46A040]" />
                        </div>
                        <h3 class="font-bold text-xl text-gray-900 mb-4">Horario</h3>
                        <p class="text-gray-600">Lunes a Viernes</p>
                        <p class="text-[#46A040] font-semibold">8:00 AM – 7:00 PM</p>
                        <div class="mt-4 h-px bg-gray-100"></div>
                        <p class="mt-4 text-gray-600">Sábados</p>
                        <p class="text-[#46A040] font-semibold">8:00 AM – 2:00 PM</p>
                    </div>
                </div>

                {{-- COLUMNA DERECHA --}}
                <div class="space-y-8">
                    <div class="bg-gradient-to-br from-[#46A040] to-[#2d7b2d] rounded-[32px] p-10 text-white shadow-2xl">
                        <span class="uppercase tracking-[4px] text-green-100">Atención personalizada</span>
                        <h3 class="text-4xl font-bold mt-4 leading-tight">¿Cómo podemos ayudarte?</h3>
                        <p class="mt-6 text-green-100 leading-8">
                            Nuestro equipo está preparado para responder tus consultas,
                            asesorarte y ofrecer soluciones tecnológicas adaptadas a tus necesidades.
                        </p>
                        <div class="grid gap-5 mt-10">
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-5 flex gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                                    <x-icon name="message-circle" class="w-6 h-6" />
                                </div>
                                <div>
                                    <h4 class="font-semibold">Consultas</h4>
                                    <p class="text-green-100 text-sm">Información sobre nuestros servicios.</p>
                                </div>
                            </div>
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-5 flex gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                                    <x-icon name="wrench" class="w-6 h-6" />
                                </div>
                                <div>
                                    <h4 class="font-semibold">Soporte Técnico</h4>
                                    <p class="text-green-100 text-sm">Ayuda especializada para resolver incidencias.</p>
                                </div>
                            </div>
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-5 flex gap-4">
                                <div class="w-12 h-12 rounded-xl bg-white/20 flex items-center justify-center shrink-0">
                                    <x-icon name="target" class="w-6 h-6" />
                                </div>
                                <div>
                                    <h4 class="font-semibold">Cotizaciones</h4>
                                    <p class="text-green-100 text-sm">Solicita una propuesta personalizada.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 flex flex-wrap gap-4">
                            <a href="https://wa.me/5350994365" target="_blank" class="bg-white text-[#46A040] rounded-full px-7 py-4 font-semibold hover:scale-105 transition inline-flex items-center gap-2">
                                <x-icon name="message-circle" class="w-5 h-5" />
                                Escribir por WhatsApp
                            </a>
                            <a href="mailto:tecnoelectronicasurl@gmail.com" class="border border-white/40 rounded-full px-7 py-4 hover:bg-white/10 transition inline-flex items-center gap-2">
                                <x-icon name="mail" class="w-5 h-5" />
                                Enviar Email
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- MAPA --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-[#46A040] uppercase tracking-[5px] font-semibold">Ubicación</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-4">Visítanos</h2>
                <p class="mt-6 text-gray-600 max-w-3xl mx-auto">
                    Estamos ubicados en el corazón de Santa Clara. Si prefieres una atención presencial,
                    estaremos encantados de recibirte.
                </p>
            </div>
            <div class="rounded-[36px] overflow-hidden shadow-2xl border border-gray-100">
                <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=-79.975%2C22.395%2C-79.955%2C22.415&amp;layer=transport&amp;marker=22.4064%2C-79.9647" class="w-full h-[550px]" loading="lazy" title="Ubicación Tecnoelectronica SURL"></iframe>
            </div>
            <div class="mt-8 flex justify-center">
                <a href="https://maps.google.com/?q=22.4064,-79.9647" target="_blank" class="bg-[#46A040] hover:bg-[#3d8f39] text-white px-8 py-4 rounded-full font-semibold shadow-lg transition-all hover:scale-105 inline-flex items-center gap-2">
                    <x-icon name="map-pin" class="w-5 h-5" />
                    Abrir en Google Maps
                </a>
            </div>
        </div>
    </section>

    {{-- CTA FINAL --}}
    <section class="pb-28 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="relative overflow-hidden rounded-[40px]">
                <div class="absolute inset-0 bg-gradient-to-r from-[#46A040] to-[#2d7b2d]"></div>
                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top_right,white,transparent_40%)]"></div>
                <div class="relative z-10 py-20 px-10 lg:px-20 text-center">
                    <span class="uppercase tracking-[5px] text-green-100">Contacto</span>
                    <h2 class="mt-6 text-4xl lg:text-5xl font-bold text-white">¿Listo para comenzar?</h2>
                    <p class="mt-8 max-w-3xl mx-auto text-green-100 text-lg leading-8">
                        Escríbenos hoy mismo y descubre cómo podemos ayudarte
                        con soluciones tecnológicas diseñadas para tus necesidades.
                    </p>
                    <div class="mt-12 flex flex-wrap justify-center gap-5">
                        <a href="https://wa.me/5350994365" target="_blank" class="bg-white text-[#46A040] px-8 py-4 rounded-full font-semibold hover:scale-105 transition-all shadow-xl inline-flex items-center gap-2">
                            <x-icon name="message-circle" class="w-5 h-5" />
                            Contactar por WhatsApp
                        </a>
                        <a href="mailto:tecnoelectronicasurl@gmail.com" class="border border-white/30 text-white px-8 py-4 rounded-full hover:bg-white/10 transition-all inline-flex items-center gap-2">
                            <x-icon name="mail" class="w-5 h-5" />
                            Enviar un correo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="flex flex-col">

    <div class="relative pt-28 pb-20 bg-gray-900 overflow-hidden">
        <img src="https://picsum.photos/seed/contacto/1920/600" alt="Contacto" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40" />
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
            <span class="inline-flex items-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 px-5 py-2 text-sm text-white tracking-widest uppercase mb-6">
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

    <section class="py-24 bg-gray-50">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="grid lg:grid-cols-12 gap-8 items-stretch">

                <div class="lg:col-span-5 bg-white rounded-3xl border border-gray-200 shadow-sm p-8 md:p-10">
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Información de contacto</h2>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                <x-icon name="map-pin" class="w-5 h-5 text-[#46A040]" />
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Dirección</h3>
                                <p class="text-sm text-gray-500 mt-0.5">Calle Cuba, No. 367, Sur, entre Carretera Central y Serafín Sánchez, Santa Clara, Villa Clara.</p>
                            </div>
                        </div>

                        <hr class="border-gray-100" />

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                <x-icon name="mail" class="w-5 h-5 text-[#46A040]" />
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Correo electrónico</h3>
                                <a href="mailto:tecnoelectronicasurl@gmail.com" class="text-sm text-[#46A040] font-medium hover:underline mt-0.5 block">
                                    tecnoelectronicasurl@gmail.com
                                </a>
                            </div>
                        </div>

                        <hr class="border-gray-100" />

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                <x-icon name="message-circle" class="w-5 h-5 text-[#46A040]" />
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">WhatsApp</h3>
                                <div class="space-y-1 mt-1">
                                    <a href="https://wa.me/5350994365" target="_blank" class="text-sm text-[#46A040] font-medium hover:underline block">
                                        +53 50994365
                                    </a>
                                    <a href="https://wa.me/5350927120" target="_blank" class="text-sm text-[#46A040] font-medium hover:underline block">
                                        +53 50927120
                                    </a>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100" />

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center shrink-0">
                                <x-icon name="clock" class="w-5 h-5 text-[#46A040]" />
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-900">Horario de atención</h3>
                                <div class="space-y-1 mt-1 text-sm text-gray-500">
                                    <p>Lunes a Viernes: <span class="text-gray-700 font-medium">8:00 AM – 7:00 PM</span></p>
                                    <p>Sábados: <span class="text-gray-700 font-medium">8:00 AM – 2:00 PM</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-7 bg-white rounded-3xl border border-gray-200 shadow-sm p-8 md:p-10 flex flex-col justify-center">
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-[#ecf8ef] rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <x-icon name="message-circle" class="w-8 h-8 text-[#46A040]" />
                        </div>
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">¿Prefieres escribirnos?</h2>
                        <p class="text-gray-500 mb-6">Contáctanos directamente por WhatsApp y te atenderemos al instante.</p>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                            <a href="https://wa.me/5350994365" target="_blank"
                               class="inline-flex items-center gap-2 px-6 py-3 bg-[#46A040] text-white font-semibold rounded-full hover:bg-[#3d8c38] transition-colors shadow-md shadow-[#46A040]/20">
                                <x-icon name="message-circle" class="w-5 h-5" />
                                Abrir WhatsApp
                            </a>
                            <a href="mailto:tecnoelectronicasurl@gmail.com"
                               class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-full hover:bg-gray-200 transition-colors">
                                <x-icon name="mail" class="w-5 h-5" />
                                Enviar correo
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-900">Nuestra sede</h2>
                    <p class="text-gray-500 text-sm mt-1">Santa Clara, Villa Clara</p>
                </div>
                <a href="https://maps.google.com/?q=22.4064,-79.9647" target="_blank"
                   class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                    <x-icon name="map" class="w-4 h-4" />
                    Abrir en Google Maps
                </a>
            </div>

            <div class="relative rounded-3xl overflow-hidden shadow-sm border border-gray-200 h-[400px] bg-gray-100">
                <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=-79.975%2C22.395%2C-79.955%2C22.415&amp;layer=transport&amp;marker=22.4064%2C-79.9647" class="w-full h-full grayscale-[0.2] contrast-125 hover:grayscale-0 transition-all duration-700" style="border:0;" allowfullscreen loading="lazy" title="Ubicación Tecnoelectronica SURL"></iframe>
            </div>
        </div>
    </section>
</div>
@endsection

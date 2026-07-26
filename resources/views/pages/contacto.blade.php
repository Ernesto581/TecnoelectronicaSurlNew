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

                <div class="lg:col-span-7 bg-white rounded-3xl border border-gray-200 shadow-sm p-8 md:p-10 flex flex-col">
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Envíanos un mensaje</h2>
                        <p class="text-sm text-gray-500 mt-1">Te responderemos a tu correo lo antes posible.</p>
                    </div>

                    @if (session('contact_success'))
                        <div class="rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800 mb-6">
                            {{ session('contact_success') }}
                        </div>
                    @endif

                    <form action="{{ url('/contacto') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-1.5">Nombre <span class="text-red-500">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('name') border-red-300 @enderror" />
                            @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-1.5">Correo electrónico <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] @error('email') border-red-300 @enderror" />
                            @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-900 mb-1.5">Mensaje <span class="text-red-500">*</span></label>
                            <textarea name="message" id="message" rows="4" required
                                      class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040] resize-none @error('message') border-red-300 @enderror">{{ old('message') }}</textarea>
                            @error('message') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit"
                                class="w-full px-6 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-xl hover:bg-[#3d8c38] transition-colors">
                            Enviar mensaje
                        </button>
                    </form>
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

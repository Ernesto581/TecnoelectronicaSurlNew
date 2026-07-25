@extends('layouts.app')

@section('content')
<div class="flex flex-col">
    <div class="relative pt-32 pb-20 bg-gray-900 overflow-hidden">
        <img src="https://picsum.photos/seed/contacto/1920/600" alt="Contacto" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40" />
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white tracking-tight mb-6"><span class="text-[#46A040]">Contáctenos</span></h1>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto leading-relaxed">Estamos aquí para ayudarte. Encuéntranos en nuestro local o contáctanos por cualquiera de nuestras vías.</p>
        </div>
    </div>

    <section class="py-24 bg-white">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="space-y-10">
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="map-pin" class="w-6 h-6 text-[#46A040]" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Dirección</h3>
                            <p class="text-gray-600 leading-relaxed">Calle Cuba, No. 367, Sur, entre Carretera Central y Serafín Sánchez, Santa Clara, Villa Clara</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="mail" class="w-6 h-6 text-[#46A040]" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Correo Electrónico</h3>
                            <a href="mailto:tecnoelectronicasurl@gmail.com" class="text-[#46A040] hover:text-[#3d8c38] transition-colors font-medium">tecnoelectronicasurl@gmail.com</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="message-circle" class="w-6 h-6 text-[#46A040]" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Atención Principal (WhatsApp)</h3>
                            <a href="https://wa.me/5350994365" target="_blank" rel="noopener noreferrer" class="text-[#46A040] hover:text-[#3d8c38] transition-colors font-medium">+53 50994365</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="headphones" class="w-6 h-6 text-[#46A040]" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Soporte Secundario (WhatsApp)</h3>
                            <a href="https://wa.me/5350927120" target="_blank" rel="noopener noreferrer" class="text-[#46A040] hover:text-[#3d8c38] transition-colors font-medium">+53 50927120</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-[#ecf8ef] flex items-center justify-center shrink-0">
                            <x-icon name="clock" class="w-6 h-6 text-[#46A040]" />
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Horario de Atención</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Lunes a Viernes: 8:00 AM – 7:00 PM<br />
                                Sábados: 8:00 AM – 2:00 PM
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden shadow-lg h-[450px] bg-gray-200">
                    <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=-79.975%2C22.395%2C-79.955%2C22.415&amp;layer=transport&amp;marker=22.4064%2C-79.9647" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Ubicación Tecnoelectronica SURL"></iframe>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

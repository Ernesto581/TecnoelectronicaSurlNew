@extends('layouts.app')

@section('content')

<div class="relative pt-28 pb-20 bg-gray-900 overflow-hidden">
        <img src="/domicilio.png" alt="Servicio a Domicilio" class="absolute inset-0 w-full h-full object-cover mix-blend-overlay opacity-40" />
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>
        <div class="relative z-10 max-w-[1600px] mx-auto px-4 md:px-8 text-center pt-8">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white tracking-tight mb-6">De la tienda <br />a tu casa, <span class="text-[#46A040]">sin estrés</span></h1>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto leading-relaxed">Olvídate de las preocupaciones. Nosotros coordinamos todo para que tu pedido llegue fresco y a tiempo, directo a tu puerta.</p>
            <div class="mt-10">
                <a href="/tienda" class="inline-flex items-center gap-2 px-8 py-4 bg-[#46A040] text-white font-semibold rounded-full hover:bg-[#3d8c38] transition-colors shadow-lg shadow-[#46A040]/30">Ver Productos <x-icon name="arrow-right" class="w-4 h-4" /></a>
            </div>
        </div>
    </div>

    <section class="py-24 bg-white">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight mb-4">¿Cómo Funciona?</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">Te explicamos el camino que recorre tu compra, de la tienda a tu casa.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                $steps = [
                    (object)['icon' => 'shopping-cart', 'title' => '1. Elige y Compra', 'desc' => 'Selecciona lo que necesitas desde nuestra tienda y finaliza tu pedido en segundos.'],
                    (object)['icon' => 'package-2', 'title' => '2. Lo Preparamos', 'desc' => 'Revisamos, embalamos y protegemos cada artículo como si fuera para nosotros mismos.'],
                    (object)['icon' => 'truck', 'title' => '3. Te Mantenemos al Tanto', 'desc' => 'Recibirás actualizaciones constantes sobre la ruta y el estado de tu entrega.'],
                    (object)['icon' => 'house', 'title' => '4. Recibes y Disfrutas', 'desc' => 'Llevamos tu pedido hasta la puerta de tu casa, listo para usar.'],
                ];
                @endphp
                @foreach($steps as $step)
                <div class="relative group bg-gray-50 rounded-2xl p-8 border border-gray-100 hover:shadow-lg transition-all duration-300">
                    <div class="w-16 h-16 rounded-2xl bg-[#ecf8ef] flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <x-icon name="{{ $step->icon }}" class="w-8 h-8 text-[#46A040]" />
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $step->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $step->desc }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight mb-4">Áreas de Cobertura</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-lg">Por ahora llegamos a la provincia de <strong class="text-gray-700">Villa Clara</strong>, aunque hay algunas zonas donde todavía no podemos entregar. Estamos creciendo para alcanzar más lugares.</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="relative rounded-2xl overflow-hidden shadow-lg h-[400px] bg-gray-200">
                    <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=-80.5,22.0,-79.5,22.8&amp;layer=transport&amp;marker=22.4,-79.97" width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Mapa de Villa Clara"></iframe>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <x-icon name="map-pin" class="w-6 h-6 text-[#46A040]" />
                        <h3 class="text-xl font-bold text-gray-900">Restricciones por Municipio</h3>
                    </div>
                    <ul class="space-y-4">
                        @php
                        $zonas = [
                            'Santa Clara: Reparto Escambray (No Condado, Jibacoa).',
                            'Manicaragua: Zona rural de Jibacoa (No El Güinía).',
                            'Placetas: Benito Juárez (No Falcón).',
                            'Caibarién: Pueblo La Picadora (No Dolores).',
                            'Remedios: Zona de Heriberto (No Vueltas).',
                            'Sagua la Grande: Sitiecito (No Jumagua).',
                            'Corralillo: San Juan de los Yeras (No Quemado de Güines).',
                        ];
                        @endphp
                        @foreach($zonas as $zona)
                        <li class="flex items-start gap-3">
                            <span class="mt-1.5 w-2 h-2 rounded-full bg-[#46A040] flex-shrink-0"></span>
                            <span class="text-gray-600">{{ $zona }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-[1200px] mx-auto px-4 md:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-display font-bold text-gray-900 tracking-tight mb-4">Horarios y Plazos</h2>
                <p class="text-gray-500 max-w-2xl mx-auto text-lg">Una vez confirmado tu pedido, lo recibes en un plazo de 24 a 48 horas.</p>
            </div>
            <div class="max-w-2xl mx-auto">
                <div class="bg-gray-50 rounded-2xl p-8 border border-gray-100 text-center">
                    <x-icon name="clock" class="w-10 h-10 text-[#46A040] mx-auto mb-4" />
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Ventana de Entrega</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-center gap-3 text-gray-700">
                            <x-icon name="check-circle" class="w-5 h-5 text-[#46A040]" />
                            <span class="font-semibold">Lunes a Viernes:</span>
                            <span>8:00 AM – 7:00 PM</span>
                        </div>
                        <div class="flex items-center justify-center gap-3 text-gray-700">
                            <x-icon name="check-circle" class="w-5 h-5 text-[#46A040]" />
                            <span class="font-semibold">Sábados:</span>
                            <span>8:00 AM – 2:00 PM</span>
                        </div>
                    </div>
                    <p class="mt-8 text-gray-500 text-sm">¿Necesitas una hora específica? Avísanos y haremos lo posible por ajustarnos sin alterar nuestra ruta de entregas.</p>
                </div>
            </div>
        </div>
    </section>

@endsection
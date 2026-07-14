@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-16">
    <x-hero-carousel />
    <x-featured-categories :categories="$categories" />
    <section class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold italic tracking-tight">Novedades de la tienda</h2>
            <p class="text-gray-500 mt-2">Los equipos más solicitados en Tecnoelectronica</p>
        </div>
        <x-featured-products :products="$featuredProducts" />
    </section>
    <x-about-us />
    <x-newsletter-cta />
</div>
@endsection

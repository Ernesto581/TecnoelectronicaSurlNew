@props(['products' => []])

@php
if (empty($products)) {
    $products = [
        (object)[
            'id' => 1, 'name' => 'Equipo multifunción', 'slug' => 'equipo-multifuncion',
            'description' => 'Un producto destacado con todo lo necesario para tu hogar y oficina.',
            'price' => 1299.99, 'original_price' => 1499.99,
            'image_url' => 'https://picsum.photos/seed/featured-1/800/600',
            'badge' => 'Destacado', 'rating' => 4.8, 'reviews_count' => 154,
            'categories' => (object)['name' => 'Electrodomésticos'],
        ],
        (object)[
            'id' => 2, 'name' => 'Kit Solar Compacto', 'slug' => 'kit-solar-compacto',
            'description' => 'Solución ideal para energía renovable y ahorro en tu consumo energético.',
            'price' => 849.50, 'original_price' => null,
            'image_url' => 'https://picsum.photos/seed/featured-2/800/600',
            'badge' => 'Sostenibilidad', 'rating' => 4.6, 'reviews_count' => 82,
            'categories' => (object)['name' => 'Energía Solar'],
        ],
        (object)[
            'id' => 3, 'name' => 'Pantalla Inteligente', 'slug' => 'pantalla-inteligente',
            'description' => 'Pantalla de última generación para entretenimiento y trabajo conectado.',
            'price' => 649.99, 'original_price' => 799.99,
            'image_url' => 'https://picsum.photos/seed/featured-3/800/600',
            'badge' => 'Nuevo', 'rating' => 4.9, 'reviews_count' => 320,
            'categories' => (object)['name' => 'Tecnología'],
        ],
        (object)[
            'id' => 4, 'name' => 'Cafetera Profesional', 'slug' => 'cafetera-profesional',
            'description' => 'Perfecta para oficinas y hogares con diseño elegante y alto rendimiento.',
            'price' => 239.00, 'original_price' => null,
            'image_url' => 'https://picsum.photos/seed/featured-4/800/600',
            'badge' => 'Oferta', 'rating' => 4.7, 'reviews_count' => 64,
            'categories' => (object)['name' => 'Hogar'],
        ],
    ];
}
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($products as $product)
        <x-product-card :product="$product" />
    @endforeach
</div>

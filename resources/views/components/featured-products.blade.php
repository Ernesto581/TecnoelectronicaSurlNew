@props(['products' => null])

@php
if (!isset($products) || $products->isEmpty()) {
    $products = \App\Models\Product::with('category')
        ->where('is_active', true)
        ->where('is_featured', true)
        ->latest()
        ->take(4)
        ->get();
}
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
    @foreach($products as $product)
        <x-product-card :product="$product" />
    @endforeach
</div>

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-16">
    <div class="max-w-[900px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8 flex items-center justify-between flex-wrap gap-4">
            <div>
                <a href="{{ route('pedidos.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-4">
                    <x-icon name="chevron-left" class="w-4 h-4" />
                    Volver a mis pedidos
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Pedido #{{ $order->id }}</h1>
                <p class="text-gray-600 mt-1">{{ $order->created_at->format('d \d\e F, Y \a \l\a\s H:i') }}</p>
            </div>
            <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold
                @switch($order->status)
                    @case(App\Enums\OrderStatus::Pending) bg-amber-50 text-amber-700 @break
                    @case(App\Enums\OrderStatus::Processing) bg-blue-50 text-blue-700 @break
                    @case(App\Enums\OrderStatus::Shipped) bg-purple-50 text-purple-700 @break
                    @case(App\Enums\OrderStatus::Delivered) bg-green-50 text-green-700 @break
                    @case(App\Enums\OrderStatus::Cancelled) bg-red-50 text-red-700 @break
                    @default bg-gray-50 text-gray-700
                @endswitch
            ">
                {{ ucfirst($order->status->value) }}
            </span>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-medium text-red-800">{{ session('error') }}</div>
        @endif

        <!-- Items -->
        <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Productos</h2>
            <div class="divide-y divide-gray-100">
                @foreach ($order->items as $item)
                    <div class="flex items-center gap-4 py-4">
                        @if ($item->product->image_url)
                            <img src="{{ Str::startsWith($item->product->image_url, 'http') ? $item->product->image_url : Storage::url($item->product->image_url) }}"
                                 alt="{{ $item->product->name }}" class="w-14 h-14 rounded-xl object-cover border border-gray-200" />
                        @else
                            <div class="w-14 h-14 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center shrink-0">
                                <x-icon name="package" class="w-6 h-6 text-gray-300" />
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-gray-900 text-sm">{{ $item->product->name }}</p>
                            <p class="text-xs text-gray-400">{{ $item->quantity }} x ${{ number_format($item->unit_price, 2) }}</p>
                        </div>
                        <span class="text-sm font-bold text-gray-900">${{ number_format($item->subtotal, 2) }}</span>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-gray-100 mt-4 pt-4 flex justify-between">
                <span class="text-sm text-gray-500">Total</span>
                <span class="text-lg font-bold text-gray-900">${{ number_format($order->total, 2) }}</span>
            </div>
        </section>

        <!-- Cancel button -->
        @if ($order->status === App\Enums\OrderStatus::Pending)
            <form action="{{ route('pedidos.cancel', $order) }}" method="POST"
                  onsubmit="return confirm('¿Estás seguro de que deseas cancelar este pedido?')">
                @csrf
                <button type="submit"
                        class="px-5 py-3 text-sm font-semibold text-red-700 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                    Cancelar pedido
                </button>
            </form>
        @endif

    </div>
</div>
@endsection

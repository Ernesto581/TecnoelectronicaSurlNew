@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28 pb-16">
    <div class="max-w-[1000px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mis pedidos</h1>
            <p class="text-gray-600 mt-1">{{ $orders->total() }} pedidos realizados</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-medium text-red-800">{{ session('error') }}</div>
        @endif

        @if ($orders->isNotEmpty())
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 flex flex-col sm:flex-row sm:items-center gap-4">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-3 mb-1">
                                <span class="font-bold text-gray-900">Pedido #{{ $order->id }}</span>
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold
                                    @switch($order->status)
                                        @case(App\Enums\OrderStatus::Pending) bg-amber-50 text-amber-700 @break
                                        @case(App\Enums\OrderStatus::Shipped) bg-purple-50 text-purple-700 @break
                                        @case(App\Enums\OrderStatus::Delivered) bg-green-50 text-green-700 @break
                                        @case(App\Enums\OrderStatus::Cancelled) bg-red-50 text-red-700 @break
                                        @default bg-gray-50 text-gray-700
                                    @endswitch
                                ">
                                    {{ ucfirst($order->status->value) }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-500">
                                {{ $order->created_at->format('d \d\e F, Y') }} &middot;
                                {{ $order->items_count }} {{ $order->items_count === 1 ? 'producto' : 'productos' }}
                            </p>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="text-lg font-bold text-gray-900">${{ number_format($order->total, 2) }}</span>

                            <a href="{{ route('pedidos.show', $order) }}"
                               class="px-4 py-2 text-sm font-semibold text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition-colors">
                                Ver detalle
                            </a>

                            @if ($order->status === App\Enums\OrderStatus::Pending)
                                <form action="{{ route('pedidos.cancel', $order) }}" method="POST"
                                      onsubmit="return confirm('¿Cancelar este pedido?')">
                                    @csrf
                                    <button type="submit"
                                            class="px-4 py-2 text-sm font-semibold text-red-700 bg-red-50 rounded-full hover:bg-red-100 transition-colors">
                                        Cancelar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($orders->hasPages())
                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-12 text-center">
                <x-icon name="package-check" class="w-12 h-12 text-gray-200 mx-auto mb-3" />
                <p class="text-gray-500">Aún no has realizado ningún pedido.</p>
                <a href="{{ route('store.index') }}" class="inline-flex mt-4 px-5 py-2.5 bg-[#46A040] text-white text-sm font-semibold rounded-full hover:bg-[#3d8c38] transition-colors">
                    Ir a la tienda
                </a>
            </div>
        @endif

    </div>
</div>
@endsection

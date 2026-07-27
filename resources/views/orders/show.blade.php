@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1000px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8 flex items-center justify-between flex-wrap gap-4">
            <div>
                <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-4">
                    <x-icon name="chevron-left" class="w-4 h-4" />
                    Volver a pedidos
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Pedido #{{ $order->id }}</h1>
                <p class="text-gray-600 mt-1">{{ $order->created_at->isoFormat('LL [a las] HH:mm') }}</p>
            </div>
            <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-semibold
                @switch($order->status)
                    @case(App\Enums\OrderStatus::Pending) bg-amber-50 text-amber-700 @break
                    @case(App\Enums\OrderStatus::Shipped) bg-purple-50 text-purple-700 @break
                    @case(App\Enums\OrderStatus::Delivered) bg-green-50 text-green-700 @break
                    @case(App\Enums\OrderStatus::Cancelled) bg-red-50 text-red-700 @break
                    @default bg-gray-50 text-gray-700
                @endswitch
            ">
                {{ $order->status->label() }}
            </span>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-medium text-red-800">{{ session('error') }}</div>
        @endif

        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Items -->
            <div class="lg:col-span-2">
                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
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
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Customer info -->
                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Cliente</h2>
                    <p class="font-semibold text-gray-900">{{ $order->user?->name ?? 'Usuario eliminado' }}</p>
                    <p class="text-sm text-gray-500">{{ $order->user?->email ?? '' }}</p>
                </section>

                <!-- Shipping info -->
                @if ($order->shipping_address)
                    <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Envío</h2>
                        <p class="text-sm text-gray-700">{{ $order->shipping_address }}</p>
                        <p class="text-sm text-gray-500">
                            {{ collect([$order->shipping_city, $order->shipping_state, $order->shipping_zip])->filter()->join(', ') }}
                        </p>
                        @if ($order->shipping_country)
                            <p class="text-sm text-gray-500">{{ $order->shipping_country }}</p>
                        @endif
                    </section>
                @endif

                <!-- Status management -->
                @if ($order->status !== App\Enums\OrderStatus::Delivered && $order->status !== App\Enums\OrderStatus::Cancelled)
                    <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Cambiar estado</h2>

                        <form action="{{ route('orders.updateStatus', $order) }}" method="POST" class="space-y-3">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                    class="w-full rounded-xl border border-gray-200 px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#46A040]/30 focus:border-[#46A040]">
                                <option value="">Seleccionar estado...</option>
                                @foreach (App\Enums\OrderStatus::cases() as $s)
                                    @if ($s !== App\Enums\OrderStatus::Cart && $s !== $order->status)
                                        <option value="{{ $s->value }}">{{ $s->label() }}</option>
                                    @endif
                                @endforeach
                            </select>

                            <button type="submit"
                                    class="w-full px-4 py-3 text-sm font-semibold text-white bg-[#46A040] rounded-xl hover:bg-[#3d8c38] transition-colors">
                                Actualizar estado
                            </button>
                        </form>
                    </section>
                @endif

                <!-- Notes -->
                @if ($order->notes)
                    <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6">
                        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-3">Notas</h2>
                        <p class="text-sm text-gray-700">{{ $order->notes }}</p>
                    </section>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

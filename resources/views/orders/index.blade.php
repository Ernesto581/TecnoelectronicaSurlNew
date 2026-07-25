@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Pedidos</h1>
                <p class="text-gray-600 mt-1">{{ $orders->total() }} pedidos registrados</p>
            </div>
        </div>

        <!-- Status filter -->
        <div class="mb-6 flex flex-wrap gap-2">
            <a href="{{ route('orders.index') }}"
               class="px-4 py-2 rounded-full text-sm font-semibold transition-colors
                      {{ !request('status') ? 'bg-[#46A040] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                Todos
            </a>
            @foreach ($statuses as $status)
                <a href="{{ route('orders.index', ['status' => $status->value]) }}"
                   class="px-4 py-2 rounded-full text-sm font-semibold transition-colors
                          {{ request('status') === $status->value ? 'bg-[#46A040] text-white' : 'bg-white text-gray-600 border border-gray-200 hover:bg-gray-50' }}">
                    {{ ucfirst($status->value) }}
                </a>
            @endforeach
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-6 py-4 text-sm font-medium text-green-800">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-6 py-4 text-sm font-medium text-red-800">{{ session('error') }}</div>
        @endif

        <section class="bg-white rounded-3xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-gray-700">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="py-4 px-6 font-semibold text-gray-900">Pedido</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Cliente</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Fecha</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Estado</th>
                            <th class="py-4 px-6 font-semibold text-gray-900">Total</th>
                            <th class="py-4 px-6 font-semibold text-gray-900 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-gray-900">#{{ $order->id }}</span>
                                    <span class="text-xs text-gray-400 ml-2">{{ $order->items->count() }} items</span>
                                </td>
                                <td class="py-4 px-6">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $order->user?->name ?? 'Usuario eliminado' }}</p>
                                        <p class="text-xs text-gray-400">{{ $order->user?->email ?? '' }}</p>
                                    </div>
                                </td>
                                <td class="py-4 px-6 text-gray-500">
                                    {{ $order->created_at->format('d/m/Y') }}
                                    <span class="text-xs text-gray-400 block">{{ $order->created_at->format('H:i') }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold
                                        @switch($order->status)
                                            @case(App\Enums\OrderStatus::Pending)
                                                bg-amber-50 text-amber-700
                                                @break
                                            @case(App\Enums\OrderStatus::Shipped)
                                                bg-purple-50 text-purple-700
                                                @break
                                            @case(App\Enums\OrderStatus::Delivered)
                                                bg-green-50 text-green-700
                                                @break
                                            @case(App\Enums\OrderStatus::Cancelled)
                                                bg-red-50 text-red-700
                                                @break
                                            @default
                                                bg-gray-50 text-gray-700
                                        @endswitch
                                    ">
                                        {{ $order->status->value }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-[#046b22]">${{ number_format($order->total, 2) }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('orders.show', $order) }}"
                                           class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">
                                            Ver
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-16 text-center text-gray-400">
                                    <x-icon name="package-check" class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                                    <p class="font-medium">No hay pedidos registrados</p>
                                    <p class="text-sm mt-1">Los pedidos aparecerán aquí cuando los clientes confirmen sus carritos.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($orders->hasPages())
                <div class="border-t border-gray-100 px-6 py-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </section>
    </div>
</div>
@endsection

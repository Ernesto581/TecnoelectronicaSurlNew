@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1200px] mx-auto px-4 md:px-8 py-10">
        <div class="mb-8 flex items-center justify-between">
            <a href="{{ route('users.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver a usuarios
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1">
                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 text-center">
                    <div class="w-20 h-20 rounded-full bg-[#ecf8ef] flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-[#46A040]">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                    <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                    <div class="mt-4">
                        @if ($user->isAdmin())
                            <span class="inline-flex items-center rounded-full bg-[#ecf8ef] px-3 py-1 text-xs font-semibold text-[#23612d]">Administrador</span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600">Cliente</span>
                        @endif
                    </div>
                </section>

                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8 mt-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Datos de la cuenta</h2>
                    <dl class="space-y-4 text-sm">
                        <div>
                            <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">ID</dt>
                            <dd class="text-gray-900 mt-1">{{ $user->id }}</dd>
                        </div>
                        <div>
                            <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Email verificado</dt>
                            <dd class="mt-1">
                                @if ($user->email_verified_at)
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                                        Verificado
                                    </span>
                                    <span class="text-gray-500 ml-2">{{ $user->email_verified_at->isoFormat('DD/MM/YYYY') }}</span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-0.5 text-xs font-semibold text-amber-700">
                                            Sin verificar
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Fecha de registro</dt>
                                <dd class="text-gray-900 mt-1">{{ $user->created_at->isoFormat('LL') }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Ultima actualizacion</dt>
                                <dd class="text-gray-900 mt-1">{{ $user->updated_at->isoFormat('LL') }}</dd>
                        </div>
                    </dl>
                </section>
            </div>

            <div class="lg:col-span-2">
                <section class="bg-white rounded-3xl border border-gray-200 shadow-sm p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-[#ecf8ef] flex items-center justify-center">
                            <x-icon name="shopping-bag" class="w-5 h-5 text-[#46A040]" />
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Historial de pedidos</h2>
                            <p class="text-sm text-gray-500">{{ $user->orders->count() }} pedidos realizados</p>
                        </div>
                    </div>

                    @forelse ($user->orders as $order)
                        <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5 @if (!$loop->last) mb-3 @endif">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                <div>
                                    <p class="font-semibold text-gray-900">Pedido #{{ $order->id }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->created_at->isoFormat('DD/MM/YYYY') }}</p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-semibold text-gray-600">
                                        {{ $order->status->value }}
                                    </span>
                                    <span class="font-semibold text-[#046b22]">${{ number_format($order->total, 2) }}</span>
                                </div>
                            </div>
                            @if ($order->shipping_city)
                                <p class="text-xs text-gray-500 mt-2">Envio: {{ $order->shipping_city }}, {{ $order->shipping_state }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-400">
                            <x-icon name="shopping-bag" class="w-10 h-10 mx-auto mb-3 text-gray-300" />
                            <p class="font-medium">Sin pedidos registrados</p>
                        </div>
                    @endforelse
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

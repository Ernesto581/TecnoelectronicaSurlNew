@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 pt-28">
    <div class="max-w-[1600px] mx-auto px-4 md:px-8 py-10">

        <div class="mb-8">
            <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#46A040] transition-colors mb-2">
                <x-icon name="chevron-left" class="w-4 h-4" />
                Volver al perfil
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Estadísticas</h1>
            <p class="text-sm text-gray-500 mt-1">Resumen comercial</p>
        </div>

        <!-- KPIs -->
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Ingresos del mes</p>
                <p class="text-2xl font-bold text-[#046b22]">${{ number_format($kpis['revenue_month'], 2) }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Pedidos pendientes</p>
                <p class="text-2xl font-bold text-amber-600">{{ $kpis['pending_orders'] }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Productos activos</p>
                <p class="text-2xl font-bold text-[#046b22]">{{ $kpis['active_products'] }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Clientes nuevos</p>
                <p class="text-2xl font-bold text-blue-600">{{ $kpis['new_customers'] }}</p>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Tasa de conversión</p>
                <p class="text-2xl font-bold text-gray-700">
                    @php
                        $total = $kpis['delivered_count'] + $kpis['cancelled_count'];
                    @endphp
                    {{ $total > 0 ? round(($kpis['delivered_count'] / $total) * 100) : 0 }}%
                </p>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Ingresos últimos 6 meses</h2>
                <canvas id="revenueChart" height="200"></canvas>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Pedidos por estado</h2>
                <canvas id="ordersChart" height="200"></canvas>
            </div>
        </div>

        <!-- Tables -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Top 5 productos</h2>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="pb-2">Producto</th>
                            <th class="pb-2 text-right">Unidades</th>
                            <th class="pb-2 text-right">Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topProducts as $p)
                            <tr class="border-b border-gray-50">
                                <td class="py-2 text-gray-700">{{ $p['name'] }}</td>
                                <td class="py-2 text-right font-semibold">{{ $p['quantity'] }}</td>
                                <td class="py-2 text-right text-[#046b22] font-semibold">${{ number_format($p['revenue'], 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-4 text-center text-gray-400">Sin datos</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Top 5 clientes</h2>
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-gray-400 uppercase tracking-wider border-b border-gray-100">
                            <th class="pb-2">Cliente</th>
                            <th class="pb-2 text-right">Pedidos</th>
                            <th class="pb-2 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($topCustomers as $c)
                            <tr class="border-b border-gray-50">
                                <td class="py-2 text-gray-700">{{ $c['name'] }}</td>
                                <td class="py-2 text-right">{{ $c['orders'] }}</td>
                                <td class="py-2 text-right text-[#046b22] font-semibold">${{ number_format($c['total'], 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-4 text-center text-gray-400">Sin datos</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Low stock -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
            <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">
                Stock crítico
                <span class="ml-2 text-xs font-normal text-gray-400">(5 o menos unidades)</span>
            </h2>
            @if (count($lowStock) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                    @foreach ($lowStock as $product)
                        <div class="bg-gray-50 rounded-xl p-3 text-center">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $product['name'] }}</p>
                            <p class="text-xs {{ $product['stock'] == 0 ? 'text-red-600' : 'text-amber-600' }} font-bold">
                                {{ $product['stock'] == 0 ? 'Agotado' : $product['stock'] . ' unid.' }}
                            </p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400">Todos los productos tienen stock suficiente.</p>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Revenue chart
    new Chart(document.getElementById('revenueChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($revenueByMonth, 'month')) !!},
            datasets: [{
                label: 'Ingresos',
                data: {!! json_encode(array_column($revenueByMonth, 'total')) !!},
                backgroundColor: '#46A040',
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    ticks: { callback: v => '$' + v }
                }
            }
        }
    });

    // Orders by status chart
    new Chart(document.getElementById('ordersChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_column($ordersByStatus, 'label')) !!},
            datasets: [{
                data: {!! json_encode(array_column($ordersByStatus, 'count')) !!},
                backgroundColor: ['#f59e0b', '#8b5cf6', '#22c55e', '#ef4444'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection

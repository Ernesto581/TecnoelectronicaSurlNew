<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

/**
 * Provides business statistics and KPIs for the admin dashboard.
 */
class StatisticsController extends Controller
{
    /**
     * Display the statistics dashboard.
     */
    public function index(): View
    {
        return view('statistics.index', [
            'kpis' => $this->kpis(),
            'revenueByMonth' => $this->revenueByMonth(),
            'ordersByStatus' => $this->ordersByStatus(),
            'topProducts' => $this->topProducts(),
            'topCustomers' => $this->topCustomers(),
            'lowStock' => $this->lowStock(),
        ]);
    }

    /**
     * Key performance indicators.
     */
    private function kpis(): array
    {
        $thisMonth = now()->month;
        $thisYear = now()->year;

        return [
            'revenue_month' => Order::where('status', OrderStatus::Delivered)
                ->whereYear('updated_at', $thisYear)
                ->whereMonth('updated_at', $thisMonth)
                ->sum('total'),

            'pending_orders' => Order::where('status', OrderStatus::Pending)->count(),

            'active_products' => Product::where('is_active', true)->count(),

            'new_customers' => User::whereMonth('created_at', $thisMonth)
                ->whereYear('created_at', $thisYear)
                ->count(),

            'delivered_count' => Order::where('status', OrderStatus::Delivered)->count(),
            'cancelled_count' => Order::where('status', OrderStatus::Cancelled)->count(),
        ];
    }

    /**
     * Monthly revenue for the last 6 months.
     */
    private function revenueByMonth(): array
    {
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $total = Order::where('status', OrderStatus::Delivered)
                ->whereYear('updated_at', $date->year)
                ->whereMonth('updated_at', $date->month)
                ->sum('total');

            $data[] = [
                'month' => $date->translatedFormat('M'),
                'total' => $total,
            ];
        }

        return $data;
    }

    /**
     * Order count grouped by status.
     */
    private function ordersByStatus(): array
    {
        $counts = [];
        foreach ([OrderStatus::Pending, OrderStatus::Shipped, OrderStatus::Delivered, OrderStatus::Cancelled] as $status) {
            $counts[] = [
                'label' => $status->label(),
                'count' => Order::where('status', $status)->count(),
            ];
        }

        return $counts;
    }

    /**
     * Top 5 best-selling products (excluding cancelled orders).
     */
    private function topProducts(): array
    {
        return OrderItem::select('product_id',
                DB::raw('SUM(quantity) as total_qty'),
                DB::raw('SUM(subtotal) as total_revenue'))
            ->whereHas('order', fn ($q) => $q->whereNot('status', OrderStatus::Cancelled))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->with('product')
            ->get()
            ->map(fn ($item) => [
                'name' => $item->product?->name ?? 'Producto eliminado',
                'quantity' => $item->total_qty,
                'revenue' => $item->total_revenue,
            ])
            ->toArray();
    }

    /**
     * Top 5 customers by total purchase volume.
     */
    private function topCustomers(): array
    {
        return Order::select('user_id',
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM(total) as total_spent'))
            ->where('status', OrderStatus::Delivered)
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->take(5)
            ->with('user')
            ->get()
            ->map(fn ($order) => [
                'name' => $order->user?->name ?? 'Usuario eliminado',
                'orders' => $order->order_count,
                'total' => $order->total_spent,
            ])
            ->toArray();
    }

    /**
     * Products with critically low stock.
     */
    private function lowStock(): array
    {
        return Product::where('is_active', true)
            ->where('stock', '<=', 5)
            ->orderBy('stock')
            ->take(10)
            ->get()
            ->toArray();
    }
}

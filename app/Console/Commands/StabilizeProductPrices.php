<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

/**
 * Stabilizes product prices after 30 days without changes.
 *
 * When a product's price has not changed for 30 days, the current price
 * becomes the new "original price" — the baseline against which future
 * discounts are measured.
 */
class StabilizeProductPrices extends Command
{
    protected $signature = 'products:stabilize-prices';

    protected $description = 'Set original_price for products whose price has been stable for 30 days.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $updated = Product::whereNotNull('price_changed_at')
            ->where('price_changed_at', '<=', now()->subDays(30))
            ->where(function ($query) {
                $query->whereNull('original_price')
                      ->orWhereColumn('original_price', '!=', 'price');
            })
            ->update(['original_price' => \DB::raw('price')]);

        $this->info("{$updated} product prices stabilized.");

        return self::SUCCESS;
    }
}

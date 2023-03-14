<?php

namespace App\Observers;

use App\Models\Basket_item;
use App\Models\Item_stat;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class BasketItemObserver
{
    /**
     * Handle the Basket_item "created" event.
     */
    public function created(Basket_item $basket_item): void
    {
        $Item_stat = $this->firstOrNewAndCheckForNullValues($basket_item['product_id']);

        $Item_stat->addedCount++;

        $Item_stat->save();
    }

    /**
     * Handle the Basket_item "deleted" event.
     */
    public function deleted(Basket_item $basket_item): void
    {
        $productIds = request()->input('ids.*.product_id');

        $item_stats = [];
        $currentTime = Carbon::now()->toDateTimeString();

        foreach ($productIds as $product_id) {
            $Item_stat = $this->firstOrNewAndCheckForNullValues($product_id);

            if (request('stat_type') == 'checkout')
                $Item_stat->purchasedCount += 1;
            else
                $Item_stat->removedCount += 1;

            $Item_stat = $Item_stat->toArray();
            $Item_stat['created_at'] = $currentTime;
            $Item_stat['updated_at'] = $currentTime;
            Arr::forget($Item_stat, ['product']);

            $item_stats[] = $Item_stat;
        }

        Item_stat::upsert($item_stats, ['id']);
    }

    public function firstOrNewAndCheckForNullValues($product_id)
    {
        $Item_stat = Item_stat::firstOrNew([
            'product_id' => $product_id
        ]);
        if ($Item_stat->addedCount == null)
            $Item_stat->addedCount = 0;
        if ($Item_stat->purchasedCount == null)
            $Item_stat->purchasedCount = 0;
        if ($Item_stat->removedCount == null)
            $Item_stat->removedCount = 0;

        return $Item_stat;
    }
}

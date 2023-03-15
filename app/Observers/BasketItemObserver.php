<?php

namespace App\Observers;

use App\Models\Basket_item;
use App\Models\Item_stat;
use App\Repositories\ItemStatRepo;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class BasketItemObserver
{
    /**
     * Handle the Basket_item "created" event.
     */
    public function created(Basket_item $basket_item): void
    {
        $itemStatRepo = new ItemStatRepo();
        $itemStatRepo->incrementFieldCount($basket_item['product_id'], 'addedCount');
    }
}

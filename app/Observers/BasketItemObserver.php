<?php

namespace App\Observers;

use App\Models\Basket_item;
use App\Repositories\ItemStatRepo;

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

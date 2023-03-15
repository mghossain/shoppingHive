<?php

namespace App\Http\Controllers;

use App\Repositories\BasketItemRepo;
use App\Repositories\ItemStatRepo;

class BasketItemController extends Controller
{
    private BasketItemRepo $basketItemRepo;

    public function __construct()
    {
        $this->basketItemRepo = new BasketItemRepo();
    }

    public function index()
    {
        $basketItems = $this->basketItemRepo->getAllBasketItemsPaginated();

        return response([
            'data' => $basketItems,
            'status' => 'success'
        ]);
    }
    public function store()
    {
        $attributes = request()->validate([
           'product_id' => 'required|exists:products,id|unique:basket_items,product_id'
        ]);

        $basketItem = $this->basketItemRepo->createBasketItem($attributes);

        return response([
            'data' => $basketItem,
            'status' => 'success'
        ]);
    }

    public function destroy()
    {
        $attributes = request()->validate([
            'ids.*.product_id' => 'required|exists:products,id|exists:basket_items,product_id'
        ]);

        $ids = request()->input('ids.*.id');
        $productIds = request()->input('ids.*.product_id');
        $itemStatRepo = new ItemStatRepo();

        $this->basketItemRepo->deleteBasketItems($ids);

        foreach ($productIds as $product_id) {
            $fieldName = 'removedCount';
            if (request('stat_type') == 'checkout')
                $fieldName = 'purchasedCount';

            $itemStatRepo->incrementFieldCount($product_id, $fieldName);
        }

        return response([
            'data' => $ids,
            'status' => 'success'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\BasketItemRepo;
use App\Models\Basket_item;

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

        if ($basketItems != null)
            return response([
                'data' => $basketItems,
                'status' => 'success'
            ]);
        else
            return response(['error' => 'Unauthorized'], 400);
    }
    public function store()
    {
        $attributes = request()->validate([
           'product_id' => 'required'
        ]);


        if ($this->basketItemRepo->isItemInBasket($attributes['product_id'])) {
            return response([
                'status' => 'exists'
            ]);
        }

        try {
            $basketItem = $this->basketItemRepo->createBasketItem($attributes);
        } catch (\Exception $e) {
            return response(['error' => 'Unauthorized'], 400);
        }

        return response([
            'data' => $basketItem,
            'status' => 'success'
        ]);
    }

    public function destroy()
    {
        $ids = request()->input('ids.*.id');
        $model = new Basket_item();

        try {
            $model->withoutEvents(function () use ($ids) {
                $this->basketItemRepo->deleteBasketItems($ids);
            });
            $model->fireEvent('deleted');
        } catch (\Exception $e) {
                return response(['error' => $e.'Unauthorized'], 400);
            }

        return response([
            'data' => $ids,
            'status' => 'success'
        ]);
    }
}

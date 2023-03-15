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

        return response([
            'data' => $basketItems,
            'status' => 'success'
        ]);
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

        $basketItem = $this->basketItemRepo->createBasketItem($attributes);

        return response([
            'data' => $basketItem,
            'status' => 'success'
        ]);
    }

    public function destroy()
    {
        $ids = request()->input('ids.*.id');
        $model = new Basket_item();

        $model->withoutEvents(function () use ($ids) {
            $this->basketItemRepo->deleteBasketItems($ids);
        });
        $model->fireEvent('deleted');

        return response([
            'data' => $ids,
            'status' => 'success'
        ]);
    }
}

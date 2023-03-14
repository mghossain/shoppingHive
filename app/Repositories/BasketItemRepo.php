<?php

namespace App\Repositories;

use App\Models\Basket_item;

class BasketItemRepo
{
    private Basket_item $model;
    public function __construct()
    {
        $this->model = new Basket_item();
    }

    public function getAllBasketItemsPaginated()
    {
        return $this->model->latest()->paginate();
    }
    public function isItemInBasket(mixed $product_id)
    {
        return $this->model->where('product_id', $product_id)->exists();
    }
    public function createBasketItem(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function deleteBasketItems(array $ids)
    {
        $this->model->destroy($ids);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\basket_item;
use Illuminate\Http\Request;

class BasketItemController extends Controller
{
    public function index()
    {
        $basketItems = Basket_item::get();

        return response($basketItems);
    }
    public function store()
    {
        $attributes = request()->validate([
           'product_id' => 'required'
        ]);

        $basketItem = Basket_item::create($attributes);

        return response(['status' => 'success']);

    }
}

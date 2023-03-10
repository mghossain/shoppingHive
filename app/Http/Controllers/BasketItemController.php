<?php

namespace App\Http\Controllers;

use App\Models\Basket_item;
use Illuminate\Http\Request;

class BasketItemController extends Controller
{
    private Basket_item $model;

    public function __construct()
    {
        $this->model = new Basket_item();
    }

    public function index()
    {
        $basketItems = $this->model->latest()->get()->groupBy('product_id');

        return response($basketItems);
    }
    public function store()
    {
        $attributes = request()->validate([
           'product_id' => 'required'
        ]);

        $basketItem = $this->model->create($attributes);

        return response([
            'data' => $basketItem,
            'status' => 'success'
        ]);
    }

    public function destroy(Basket_item $basket)
    {
        $basket->delete();

        return response([
            'data' => $basket,
            'status' => 'success'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Basket_item;
use App\Models\Item_stat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $basketItem = $this->model->create($attributes);

        return response([
            'data' => $basketItem,
            'status' => 'success'
        ]);
    }

    public function destroy(Basket_item $basket)
    {
        DB::beginTransaction();

        try {
            $basket->delete();

            $Item_stat = Item_stat::firstOrNew([
                'product_id' => $basket['product_id']
            ]);
            if ($Item_stat->addedCount == null)
                $Item_stat->addedCount = 0;
            if ($Item_stat->purchasedCount == null)
                $Item_stat->purchasedCount = 0;
            if ($Item_stat->removedCount == null)
                $Item_stat->removedCount = 0;

            if (request('stat_type') == 'checkout')
                    $Item_stat->purchasedCount += 1;
            else
                    $Item_stat->removedCount += 1;

            $Item_stat->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return response([
            'data' => $basket,
            'status' => 'success'
        ]);
    }
}

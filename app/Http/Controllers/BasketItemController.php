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
        $basketItems = $this->model->latest()->paginate();

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

        DB::beginTransaction();

        try {
            $basketItem = $this->model->create($attributes);

            $Item_stat = $this->firstOrNewAndCheckForNullValues($basketItem['product_id']);

            $Item_stat->addedCount += 1;

            $Item_stat->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response(['error' => 'Unauthorized'], 400);
        }

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

            $Item_stat = $this->firstOrNewAndCheckForNullValues($basket['product_id']);

            if (request('stat_type') == 'checkout')
                    $Item_stat->purchasedCount += 1;
            else
                    $Item_stat->removedCount += 1;

            $Item_stat->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response(['error' => 'Unauthorized'], 400);
        }

        return response([
            'data' => $basket,
            'status' => 'success'
        ]);
    }

    /**
     * @param $product_id
     * @return mixed
     */
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

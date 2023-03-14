<?php

namespace App\Http\Controllers;

use App\Models\Basket_item;
use App\Models\Item_stat;
use App\Observers\BasketItemObserver;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use stdClass;

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

        if ($this->model->where('product_id', $attributes['product_id'] )->exists()) {
            return response([
                'status' => 'exists'
            ]);
        }

        try {
            $basketItem = $this->model->create($attributes);
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

        try {
            if (is_array($ids))
            {
                $this->model->withoutEvents(function () use ($ids) {
                    $this->model->destroy($ids);
                });
                $this->model->fireEvent('deleted');
            }
        } catch (\Exception $e) {
                return response(['error' => $e.'Unauthorized'], 400);
            }

        return response([
            'data' => $ids,
            'status' => 'success'
        ]);
    }
}

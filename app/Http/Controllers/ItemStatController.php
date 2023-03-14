<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item_stat;

class ItemStatController extends Controller
{
    private Item_stat $model;

    public function __construct()
    {
        $this->model = new Item_stat();
    }

    public function index()
    {
        $stats = $this->model->latest()->paginate();

        if ($stats != null)
            return response([
                'data' => $stats,
                'status' => 'success'
            ]);
        else
            return response(['error' => 'Unauthorized'], 400);
    }
}

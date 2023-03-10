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
}

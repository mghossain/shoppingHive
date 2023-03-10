<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private Product $model;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function index()
    {
        $products = $this->model->latest()->get();

        return response([
            'data' => $products,
            'status' => 'success'
        ]);
    }
}

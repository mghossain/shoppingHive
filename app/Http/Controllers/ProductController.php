<?php

namespace App\Http\Controllers;

use App\Repositories\ProductRepo;

class ProductController extends Controller
{
    private ProductRepo $productRepo;

    public function __construct()
    {
        $this->productRepo = new ProductRepo();
    }

    public function index()
    {
        $products = $this->productRepo->getAllProductsPaginated();

        return response([
            'data' => $products,
            'status' => 'success'
        ]);
    }
}

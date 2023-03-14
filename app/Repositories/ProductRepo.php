<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepo
{
    private Product $model;
    public function __construct()
    {
        $this->model = new Product();
    }

    public function getAllProductsPaginated()
    {
        return $this->model->latest()->paginate();
    }
}

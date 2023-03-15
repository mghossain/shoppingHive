<?php

namespace App\Repositories;

use App\Models\Item_stat;

class ItemStatRepo
{
    private Item_stat $model;
    public function __construct()
    {
        $this->model = new Item_stat();
    }

    public function getAllItemStatsPaginated()
    {
        return $this->model->latest()->paginate();
    }

    public function incrementFieldCount(mixed $product_id, mixed $fieldName)
    {
        $this->model
            ->updateOrCreate([
                'product_id' => $product_id
            ])
            ->increment($fieldName);
    }
}

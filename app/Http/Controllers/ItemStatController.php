<?php

namespace App\Http\Controllers;

use App\Repositories\ItemStatRepo;

class ItemStatController extends Controller
{
    private ItemStatRepo $itemStatRepo;
    public function __construct()
    {
        $this->itemStatRepo = new ItemStatRepo();
    }

    public function index()
    {
        $stats = $this->itemStatRepo->getAllItemStatsPaginated();

        return response([
            'data' => $stats,
            'status' => 'success'
        ]);
    }
}

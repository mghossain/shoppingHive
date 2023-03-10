<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_stat extends Model
{
    protected $fillable = ['product_id', 'addedCount', 'removedCount', 'purchasedCount'];
}

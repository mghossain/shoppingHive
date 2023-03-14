<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket_item extends Model
{
    use HasFactory;
    protected $fillable = ['product_id'];
    protected $with = ['product'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
    public function fireEvent($event)
    {
        $this->fireModelEvent($event);
    }
}

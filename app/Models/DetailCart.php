<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCart extends Model
{
    use HasFactory;

    protected $fillable = ['cart_id', 'product_id', 'price', 'discount', 'amount', 'total_price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

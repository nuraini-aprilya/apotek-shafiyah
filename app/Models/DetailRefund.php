<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRefund extends Model
{
    use HasFactory;

    protected $fillable = ['refund_id', 'product_id', 'amount'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

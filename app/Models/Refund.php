<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = ['receipt_id', 'purchase_id',  'refund_date', 'amount', 'information'];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class)->withDefault();
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function detail_refund()
    {
        return $this->hasMany(DetailRefund::class);
    }
}

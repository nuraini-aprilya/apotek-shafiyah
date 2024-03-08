<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'supplier_id', 'purchase_number', 'invoice_number', 'order_date', 'expired_date', 'quantity', 'price', 'total_price', 'information'];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'detail_purchases', 'purchase_id', 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withDefault();
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class);
    }

    public function detail_purchase()
    {
        return $this->hasMany(DetailPurchase::class);
    }
}

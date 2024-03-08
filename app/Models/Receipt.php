<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = ['purchase_id', 'receipt_date', 'amount', 'information'];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class)->withDefault();
    }

    public function detail_receipt()
    {
        return $this->hasMany(DetailReceipt::class);
    }
}

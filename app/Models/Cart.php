<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['admin_id', 'customer_id', 'total_price'];

    public function details()
    {
        return $this->hasMany(DetailCart::class);
    }
}

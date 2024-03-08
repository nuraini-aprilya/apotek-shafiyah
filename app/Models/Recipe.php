<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'image', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function status()
    {
        if ($this->status == 1) {
            return 'Ditinjau';
        } elseif ($this->status == 2) {
            return 'Disetujui';
        } else {
            return 'Ditolak';
        }
    }
}

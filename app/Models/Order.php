<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

        // // Relationship with Employee
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}

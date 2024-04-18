<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        "sale_date",
        "total_price",
        "customer_id",
        "user_id"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}

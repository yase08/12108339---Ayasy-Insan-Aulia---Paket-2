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
        "paid_amount",
        "customer_id",
        "user_id",
        "sale_amount"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailSale()
    {
        return $this->hasMany(DetailSale::class);
    }
}

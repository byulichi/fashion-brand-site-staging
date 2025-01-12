<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_price',
        'session_id',
        'line_items',
        'billing_details',
        'delivery_name',
        'delivery_phone',
        'delivery_address',
        'delivery_city',
        'delivery_state',
        'delivery_postcode',
        'delivery_method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

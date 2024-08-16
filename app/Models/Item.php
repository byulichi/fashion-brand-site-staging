<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'name', 'price'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

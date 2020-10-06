<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name', 'price'
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

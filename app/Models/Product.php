<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use Translatable;
    
    public $translatedAttributes = [
        'name', 
        'description'
    ];

    protected $fillable = [
        'price',
        'is_vat_included',
        'vat_percentage',
        'shipping_cost',
    ];
}

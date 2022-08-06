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

    public function getTotal(): float
    {
        $total = $this->shipping_cost + $this->price;
        if(!$this->is_vat_included) {
            $total += $this->price * ($this->vat_percentage/100);
        }

        return $total;
    }
}

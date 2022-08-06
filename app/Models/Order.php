<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public const STATUS_IN_CART = "in_cart";

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class, 'order_id');
    }

    public function addLine(array $newLine): OrderLine
    {
        $alreadyCreateLine = $this->lines()->firstOrNew(['product_id' => $newLine['product_id']]);
        $alreadyCreateLine->quantity += $newLine['quantity'];
        $alreadyCreateLine->save();
        return $alreadyCreateLine;
    }

    public function getTotal(): float
    {
        $this->load('lines.product');
        return $this->lines->sum(function(OrderLine $line) {
            return $line->quantity * $line->product->getTotal();
        });
    }
}

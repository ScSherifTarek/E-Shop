<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    public const STATUS_BEING_FILLED = "being_filled";

    public function lines(): HasMany
    {
        return $this->hasMany(CartLine::class, 'cart_id');
    }

    public function addLine(array $newLine): CartLine
    {
        $alreadyCreateLine = $this->lines()->firstOrNew(['product_id' => $newLine['product_id']]);
        $alreadyCreateLine->quantity += $newLine['quantity'];
        $alreadyCreateLine->save();
        return $alreadyCreateLine;
    }

    public function getTotal(): float
    {
        $this->load('lines.product');
        return $this->lines->sum(function(CartLine $line) {
            return $line->quantity * $line->product->getTotal();
        });
    }
}

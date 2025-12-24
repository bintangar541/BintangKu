<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['game_id', 'name', 'sku', 'price_modal', 'price_sell', 'stock', 'is_active'];
    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

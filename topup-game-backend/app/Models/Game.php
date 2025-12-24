<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['name', 'slug', 'thumbnail', 'banner', 'category', 'is_active', 'popularity_rank'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

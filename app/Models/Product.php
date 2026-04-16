<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'stock',
        'slug',
    ];

    public function reviews()
    {
        return $this->hasMany(\App\Models\Review::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }
}
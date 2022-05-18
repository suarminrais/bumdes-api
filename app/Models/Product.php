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
        'description',
        'category',
        'stock',
    ];

    protected $with = [
        'image',
    ];
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}

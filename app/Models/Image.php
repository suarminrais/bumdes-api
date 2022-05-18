<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'imageable_id',
        'imageable_type',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'imageable_id',
        'imageable_type',
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}

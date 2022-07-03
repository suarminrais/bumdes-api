<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'phone',
        'street',
        'province',
        'city',
        'district',
        'postal',
        'addition',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

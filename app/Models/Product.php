<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */

    protected $fillable = [
        'name',
        'user_id',
        'price',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'date:d-m-Y'
    ];

}

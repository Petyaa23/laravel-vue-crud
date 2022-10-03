<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'user_id',
        'description',
        'status',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'date:d-m-Y'
    ];

    public function product(): HasMany
    {
        return $this->hasMany(Category::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    use HasFactory;

    protected $fillable = [
        'social',
        'url',
    ];

    protected $allowedIncludes = [
        'socialRestaurant' => 'socialRestaurant',
    ];

    public function socialRestaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}

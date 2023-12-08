<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact',
        'type',
        'main',
    ];

    protected $allowedIncludes = [
        'contactRestaurant' => 'contactRestaurant',
    ];

    public function contactRestaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }
}

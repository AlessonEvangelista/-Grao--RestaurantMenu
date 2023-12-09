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
        'restaurant_id',
    ];

    public $allowedIncludes = [
        'restaurant' => 'restaurant',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}

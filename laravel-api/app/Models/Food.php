<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'description',
        'values',
        'status',
    ];

    public $allowedIncludes = [
        'foodCategory' => 'foodCategory',
    ];

    public function foodCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

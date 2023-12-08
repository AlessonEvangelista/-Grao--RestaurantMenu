<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $allowedIncludes = [
        'categoriesDadCategory' => 'categoriesDadCategory',
        'categoriesFood' => 'categoriesFood',
    ];

    public function categoriesDadCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function categoriesFood(): HasMany
    {
        return $this->hasMany(Food::class);
    }
}

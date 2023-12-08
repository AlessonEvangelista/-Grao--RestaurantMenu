<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'fantasy_name',
        'company_name',
        'identification_doc',
        'describe',
        'address',
        'opening_hours',
    ];

    public $allowedIncludes = [
        'restaurantContacts' => 'restaurantContacts',
        'restaurantSocial' => 'restaurantSocial',
        'restaurantCategory' => 'restaurantCategory',
    ];

    public function restaurantContacts(): HasMany
    {
        return $this->hasMany(Contacts::class);
    }

    public function restaurantSocial(): HasMany
    {
        return $this->hasMany(Social::class);
    }

    public function restaurantCategory(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}

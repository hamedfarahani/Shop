<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    use HasFactory;

    public function attributeProductValues()
    {
        return $this->hasMany(AttributeProductValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}

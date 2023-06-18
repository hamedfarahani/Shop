<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
//    public function attributeProducts()
//    {
//        return $this->belongsToMany(Attribute::class);
//    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
}

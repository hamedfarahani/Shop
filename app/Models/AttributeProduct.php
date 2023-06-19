<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AttributeProduct extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'attribute_product';

    public function attributeProductValues()
    {
        return $this->hasMany(AttributeProductValue::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}

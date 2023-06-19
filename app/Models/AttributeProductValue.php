<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeProductValue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function attributeProduct()
    {
        return $this->belongsTo(AttributeProduct::class, 'attribute_product_id');
    }
}

<?php

namespace App\Filter;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ProductFilter extends Filters
{

    protected array $customFilters = [
        'title',
        'price',
        'sell_count',
    ];

    /**
     * @param string $value
     * @return Builder
     */
    protected function title(string $value): Builder
    {
        return $this->builder->where('title', 'like', '%' . $value . '%');
    }

    /**
     * @param $value
     * @return Builder
     */
    protected function price($value): Builder
    {
        return $this->builder->select('products.*', DB::raw('MAX(attribute_product_values.price) AS max_price'))
            ->join('attribute_product', 'products.id', '=', 'attribute_product.product_id')
            ->join('attribute_product_values', 'attribute_product.id', '=', 'attribute_product_values.attribute_product_id')
            ->orderBy('max_price', $value)
            ->groupBy('products.id');
    }

    /**
     * @param $value
     * @return Builder
     */
    protected function sellCount($value): Builder
    {
        return $this->builder->select('products.*', DB::raw('MAX(attribute_product_values.sell_count) AS max_sell_count'))
            ->join('attribute_product', 'products.id', '=', 'attribute_product.product_id')
            ->join('attribute_product_values', 'attribute_product.id', '=', 'attribute_product_values.attribute_product_id')
            ->orderBy('max_sell_count', $value)
            ->groupBy('products.id');
    }


}

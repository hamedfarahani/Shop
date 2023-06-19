<?php

namespace App\Traits;

use App\Filter\Filters;
use Illuminate\Database\Eloquent\Builder;
trait FilterableTrait
{
    /**
     * Filter scope.
     *
     * @param Builder $builder Builder.
     * @param Filters $filters Filters.
     *
     * @return Builder
     */
    public function scopeFilter(Builder $builder, Filters $filters): Builder
    {
        return $filters->apply($builder);
    }
}

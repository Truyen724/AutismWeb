<?php

namespace App\Traits;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

trait Filterable
{
    public function scopeFilter(Builder $builder, QueryFilter $filters, array $filterFields = ['*'], array $orderFields = [])
    {
        return $filters->apply($builder, $filterFields, $orderFields);
    }
}

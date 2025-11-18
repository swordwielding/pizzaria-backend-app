<?php

namespace App\Filters\Api\V1;

use Illuminate\Http\Request;
use App\Filters\Api\ApiFilter;

class ProductFilter extends ApiFilter
{ 
    protected $safeParms = [
        'id' => ['eq', 'neq', 'in'],
        'name' => ['eq', 'like'],
        'price' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'categoryId' => ['eq', 'in'],
        'tagIds' => ['in'],
        'isAvailable' => ['eq', 'neq'],
    ];

    protected $columnMap = [
        'categoryId' => 'category_id',
        'isAvailable' => 'is_available',
    ];

    protected $relationMap = [
        'tagIds' => 'tags',
    ];

    protected $columnTypes = [
        'is_available' => 'boolean',
        'price' => 'float',
    ];

}
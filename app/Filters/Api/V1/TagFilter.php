<?php

namespace App\Filters\Api\V1;

use Illuminate\Http\Request;
use App\Filters\Api\ApiFilter;

class TagFilter extends ApiFilter
{
    protected $safeParms = [
        'id' => ['eq', 'neq', 'in'],
        'name' => ['eq', 'like'],
        'products' => ['in'],
    ];

    protected $relationMap = [
        'products' => 'product',
    ];


}
<?php

namespace App\Filter\V1;

use Illuminate\Http\Request;
use App\Filter\ApiFilter;

class CustomerFilter extends ApiFilter {
    protected $safeParams = [
        'name' => ['eq', 'like'],
        'type' => ['eq', 'neq'],
        'email' => ['eq', 'like'],
        'address' => ['eq', 'like'],
        'city' => ['eq','like'],
        'state' => ['eq','like'],
        'postal_code' => ['eq', 'gt', 'lt', 'gte', 'lte']
    ];

    // protected $columnMap = [
    //     'postalCode' => 'postal_code'
    // ];

    protected $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'like' => 'like',
        'in' => 'in'
    ];

}
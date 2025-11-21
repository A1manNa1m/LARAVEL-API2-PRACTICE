<?php

namespace App\Filter\V1;

use Illuminate\Http\Request;
use App\Filter\ApiFilter;

class InvoiceFilter extends ApiFilter {

    protected $safeParams = [
        'customer_id' => ['eq', 'in'],
        'amount' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'status' => ['eq', 'ne'],
        'billed_date' => ['eq', 'lt', 'lte', 'gt', 'gte'],
        'paid_date' => ['eq', 'lt', 'lte', 'gt', 'gte'],
    ];

    // protected $columnMap = [
    //     'customerid' => 'customer_id'
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
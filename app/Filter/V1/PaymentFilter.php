<?php

namespace App\Filter\V1;

use Illuminate\Http\Request;
use App\Filter\ApiFilter;

class PaymentFilter extends ApiFilter {
    protected $safeParams = [
        'customer_id' => ['eq','in'],
        'invoice_id' => ['eq','in'],
        'amount' => ['eq','lt','lte','gt','gte'],
        'payment_method' => ['eq','like'],
        'payment_date' => ['eq','lt','lte','gt','gte']
    ];

    // protected $columnMap = [
    //     'customerid' => 'customer_id',
    //     'invoiceid' => 'invoice_id'
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
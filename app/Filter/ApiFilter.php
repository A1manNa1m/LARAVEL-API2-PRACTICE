<?php

namespace App\Filter;

use Illuminate\Http\Request;

class ApiFilter {

    //protected $columnMap = [];
    // iIf your request parameter names differ from your database column names

    protected $safeParams = [];

    protected $operatorMap = [];

    public function transform(Request $request) {
        $eloQuery = [];

        foreach ($this->safeParams as $parm => $operators) {
            $query = $request->query($parm);

            if(!isset($query)){
                continue;
            }

            $column = $parm;
            // $column = $this->columnMap[$parm] ?? $parm; 
            // iIf your request parameter names differ from your database column names

            foreach ($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery[]= [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
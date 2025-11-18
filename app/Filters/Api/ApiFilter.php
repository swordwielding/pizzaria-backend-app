<?php

namespace App\Filters\Api;

use Illuminate\Http\Request;
use PHPUnit\Framework\Constraint\Operator;

use function PHPSTORM_META\elementType;

class ApiFilter
{
    protected $safeParms = [];

    protected $columnMap = [];

    protected $operatorMap = [
        'eq' => '=',      
        'neq' => '!=',    
        'lt' => '<',      
        'lte' => '<=',    
        'gt' => '>',      
        'gte' => '>=',    
        'like' => 'like', 
        'in' => 'in',
    ];

    protected $relationMap = [];

    protected $columnTypes = [];


    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach($this->safeParms as $parm => $operators)
        {
            $query = $request->query($parm);

            if(!$query) continue;

            $column = $this->columnMap[$parm] ?? $parm;

            foreach($operators as $operator)
            {
                if(isset($query[$operator]))
                {
                    $value = $query[$operator];

                    if(isset($this->columnTypes[$column]))
                    {
                        $value = match($this->columnTypes[$column])
                        {
                            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
                            'float' => (float)$value,
                            'integer' => (int)$value,
                            default => $value,
                        };
                    }

                    if($operator === 'in')
                    {
                        $arrayValue = is_array($value) ? $value : explode(',', $value);
                        
                        if(isset($this->relationMap[$parm]))
                        {
                            $relation = $this->relationMap[$parm];
                            $eloQuery[] = ['whereHas', $relation, 'in', $arrayValue];
                        }
                        else
                        {
                            $eloQuery[] = [$column, 'in', $arrayValue];
                        }
                    }
                    else
                    {
                        $sqlOperator = $this->operatorMap[$operator];
                        $preparedValue = $sqlOperator === 'like' ? "%{$value}%" : $value;
                        $eloQuery[] = ['where', $column, $sqlOperator, $preparedValue];
                    }
                }
            }
        }

        return $eloQuery;
    }
}
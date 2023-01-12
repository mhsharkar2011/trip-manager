<?php

namespace App\Devpanel\Models;

use Carbon\Carbon;

trait FilterTrait {

    /**
    * Example request fromat
    */
    /*
    [
        'query' => [
            'sort' => [
                'created_at' => 'desc',
                'firstname' => 'asc'
            ],
            'columns' => [ //only list this columns, e.g., mysql select
                'id',
                'firstname',
                'lastname'
            ],
            'filters' => [
                'firstname' => [
                    'op' => 'contains',
                    'val' => 'john'
                ],
                'status' => [
                    'op' => 'eq',
                    'val' => 'active'
                ],
                'status' => 'active', //does the same as above, i.e., if op not mentioned then default is op = eq 
                'created_at' => [
                    'op' => 'between',
                    'type' => 'date',
                    'val' => '1/1/2017',
                    'val2' => '1/2/2017'
                ],
                'created_at' => [
                    'op' => 'gt',
                    'type' => 'date',
                    'val' => '1/1/2017',
                ],
                'user_id' => [
                    'op' => 'empty', //null or empty, e.g., reservations with no manager
                ],
            ],
        ],
    ];       
    */
    public function scopefilter($q, $params) {

        if (!isset($params['query']) || empty($params['query']))
            return $q;

        $params = $params['query'];

        $valid_operators = [
            'eq'            => '=',
            'neq'           => '<>',
            'gt'            => '>',
            'lt'            => '<',
            'gte'           => '>=',
            'lte'           => '<=',
            'between'       => 'between',
            'startswith'    => [
                'op'        => 'LIKE',
                'value'     => '%s%%'
            ],
            'endswith'      => [
                'op'        => 'LIKE',
                'value'     => '%%%s'
            ],
            'contains'      => [
                'op'        => 'LIKE',
                'value'     => '%%%s%%'
            ],
            'nstartswith'   => [
                'op'        => 'NOT LIKE',
                'value'     => '%s%%'
            ],
            'nendswith'     => [
                'op'        => 'NOT LIKE',
                'value'     => '%%%s'
            ],
            'ncontains'     => [
                'op'        => 'NOT LIKE',
                'value'     => '%%%s%%'
            ],
        ];

        $valid_sorting_orders = [
            'asc',
            'desc',
        ];

        if (isset($params['filters']) && !empty($params['filters'])) {
            foreach ($params['filters'] as $column => $filter) {
                if (is_array($filter)) { 
                    $op = $filter['op'];
                    $val = isset($filter['val'])? $filter['val'] : null;
                    $val2 = isset($filter['val2'])? $filter['val2'] : null;
                } else { 
                    $op = 'eq'; //default action is mysql equality
                    $val = $filter;
                }

                //if column is type date then change values to mysql date format
                if (isset($filter['type']) && $filter['type'] == 'date' && $val) {
                    $val = Carbon::parse($val)->toDateString(); //Y-m-d
                    $val2 = Carbon::parse($val2)->toDateString();
                }

                if ($op == 'between' && $val && $val2) {
                    $q->whereBetween($column, [$val, $val2]); //for date columns date(column) is handled by eloquent
                    continue;
                }

                if ($op == 'empty') {
                    $q->where(function($q) use ($column) {
                        $q->where($column, '=', '')->orWhereNull($column);
                    });
                    continue;
                }

                if ($op == 'nempty') {
                    $q->where(function($q) use ($column) {
                        $q->where($column, '!=', '')->orWhereNotNull($column);
                    });
                    continue;
                }

                if ($val) {
                    if (isset($filter['type']) && $filter['type'] == 'date') {
                        $column = \DB::raw("DATE(`$column`)");
                    }

                    if (isset($valid_operators[$op]) && is_array($valid_operators[$op])) {
                        $q->where($column, $valid_operators[$op]['op'], sprintf($valid_operators[$op]['value'], $val)); //e.g., NOT LIKE %foobar%, LIKE %foo etc
                    } else {
                        $q->where($column, $valid_operators[$op], $val);
                    }
                }
            }
        }

        if (isset($params['sort'])) {
            foreach ($params['sort'] as $field => $order) {
                if (in_array(strtolower($order), $valid_sorting_orders)) {
                    $q->orderBy($field, $order);
                }
            }
        }

        if (isset($params['columns']) && is_array($params['columns'])) {
            $q->select($params['columns']);
        }

        return $q;
    }

    public static function getDefaultSorting()
    {
        return [
            'query' => [
                'sort' => [
                    'id' => 'desc'
                ]
            ]
        ];
    }
}
<?php

/**
 * QueryBuilder
 * @package Modules\Orm
 * @subpackage Models\BusinessObjects
 */
abstract class QueryBuilder
{
    public $type = '';
    public $columns = array();
    public $table = '';
    public $where = array();
    public $orderBy = array();
    public $orderType = 'ASC';

    public $input = array();

    public function get(array $columns = array('*'))
    {
        $this->type = 'SELECT';
        $this->columns = $columns;

        return $this;
    }

    public function where($where, array $input = null)
    {
        $this->where[] = $where;
        if ($input !== null)
        {
            $this->input = array_merge($this->input, $input);
        }

        return $this;
    }

    public function orderBy(array $columns, OrderType $orderType)
    {
        $this->orderBy = $columns;
        $this->orderType = $orderType;

        return $this;
    }

    public function getQuery()
    {
        return 'NO QUERY';
    }
}
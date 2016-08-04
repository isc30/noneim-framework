<?php

/**
 * SQL QueryBuilder
 * @package Modules\Orm
 * @subpackage Models\BusinessObjects
 */
class SqlQueryBuilder extends QueryBuilder
{
    public $table;

    public function orderBy(array $columns, OrderType $orderType)
    {
        $this->orderBy = $columns;
        switch ($orderType)
        {
            case OrderType::ascendent:
            {
                $this->orderType = 'ASC';
                break;
            }
            case OrderType::descendent:
            {
                $this->orderType = 'DESC';
                break;
            }
        }
        return $this;
    }

    public function getQuery()
    {
        switch ($this->type)
        {
            case 'SELECT':
            {
                $query = array();

                $query[] = 'SELECT';
                if ($this->columns !== array())
                {
                    $query[] = implode(',', $this->columns);
                }
                else
                {
                    $query[] = '*';
                }

                $query[] = 'FROM';
                $query[] = "`{$this->table}`";

                if (count($this->where) > 0)
                {
                    $query[] = 'WHERE';
                    $query[] = implode(' AND ', $this->where);
                }

                if (count($this->orderBy) > 0)
                {
                    $query[] = 'ORDER BY';
                    $query[] = implode(',', $this->orderBy);
                    $query[] = $this->orderType;
                }

                return implode(' ', $query);
            }
        }
    }

    public static function create()
    {
        return new self();
    }
}
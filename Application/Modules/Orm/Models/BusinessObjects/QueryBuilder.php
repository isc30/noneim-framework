<?php

/**
 * QueryBuilder
 * @package Modules\Orm
 * @subpackage Models\BusinessObjects
 */
class QueryBuilder
{
    /** @var string[] */
    protected $columns = array('*');
    /** @var string */
    protected $table;
    /** @var string[] */
    protected $where = array();
    /** @var string[] */
    protected $orderByColumns = array();
    /** @var OrderType */
    protected $orderType = null;
    /** @var int */
    protected $limit = 0;
    /** @var int */
    protected $limitOffset = 0;
    /** @var mixed[] */
    protected $parameters = array();

    /**
     * QueryBuilder constructor.
     */
    private function __construct()
    {
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param string[] $columns
     * @return QueryBuilder
     */
    public static function get(array $columns = null)
    {
        $queryBuilder = new QueryBuilder();

        if ($columns !== null && $columns !== array())
        {
            $queryBuilder->columns = $columns;
        }

        return $queryBuilder;
    }

    /**
     * @param string $where
     * @param null|array $parameters
     * @return QueryBuilder
     */
    public function where($where, array $parameters = null)
    {
        $this->where[] = $where;

        if ($parameters !== null && $parameters !== array())
        {
            $this->parameters = array_merge($this->parameters, $parameters);
        }

        return $this;
    }

    /**
     * @param string[] $columns
     * @param OrderType $orderType
     * @return QueryBuilder
     */
    public function orderBy(array $columns, OrderType $orderType = null)
    {
        $this->orderByColumns = $columns;

        if ($orderType !== null)
        {
            $this->orderType = $orderType;
        }
        else
        {
            $this->orderType = new OrderType(OrderType::ascendent);
        }

        return $this;
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return QueryBuilder
     */
    public function limit($limit, $offset = 0)
    {
        $this->limit = $limit;
        $this->limitOffset = $offset;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        $query = array();

        $query[] = 'SELECT';
        $query[] = implode(',', $this->columns);

        $query[] = 'FROM';
        $query[] = $this->table;

        if (count($this->where) > 0)
        {
            $query[] = 'WHERE';
            $query[] = implode(' AND ', $this->where);
        }

        if (count($this->orderByColumns) > 0)
        {
            $query[] = 'ORDER BY';
            $query[] = implode(',', $this->orderByColumns);
            if ($this->orderType->value === OrderType::descendent)
            {
                $query[] = 'DESC';
            }
        }

        if ($this->limit > 0)
        {
            $query[] = 'LIMIT';
            if ($this->limitOffset > 0)
            {
                $query[] = "{$this->limit}, {$this->limitOffset}";
            }
            else
            {
                $query[] = $this->limit;
            }
        }

        return implode(' ', $query);
    }
}
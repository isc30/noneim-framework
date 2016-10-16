<?php

/**
 * Repository
 * @package Modules\Orm
 * @subpackage Models\BusinessObjects
 */
abstract class ReadOnlyRepository
{
    /** @var IConnectionContainer */
    protected $_connectionContainer;

    /**
     * Repository Constructor
     * @param IConnectionContainer $connectionContainer
     */
    public function __construct(IConnectionContainer $connectionContainer)
    {
        $this->_connectionContainer = $connectionContainer;
    }

    /** @return string */
    protected abstract function getType();

    /** @return string */
    protected abstract function getTable();

    /**
     * Fetch by id
     * TODO: return parent::_getById($id);
     * @param int $id
     * @return Entity TODO: Change 'Entity' to native type
     */
    public abstract function getById($id);

    /**
     * Fetch results to array
     * TODO: return parent::_toArray($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity TODO: Change 'Entity' to native type
     */
    public abstract function toArray(QueryBuilder $queryBuilder);

    /**
     * Fetch first result
     * TODO: return parent::_first($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity TODO: Change 'Entity' to native type
     */
    public abstract function first(QueryBuilder $queryBuilder);

    /**
     * Fetch first result or null if not exists
     * TODO: return parent::_firstOrDefault($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity TODO: Change 'Entity' to native type
     */
    public abstract function firstOrDefault(QueryBuilder $queryBuilder);

    /**
     * Fetch single result
     * TODO: return parent::_single($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity TODO: Change 'Entity' to native type
     */
    public abstract function single(QueryBuilder $queryBuilder);

    /**
     * Fetch single result or null if entity is null or there are more than 1 results
     * TODO: return parent::_singleOrDefault($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity TODO: Change 'Entity' to native type
     */
    public abstract function singleOrDefault(QueryBuilder $queryBuilder);

    /**
     * Fetch by id
     * @param int $id
     * @return Entity
     */
    protected function _getById($id)
    {
        return $this->_single(QueryBuilder::get()->where('id = :id', array('id' => $id)));
    }

    /**
     * Fetch results to array
     * @param QueryBuilder $sqlQueryBuilder
     * @return Entity[]
     */
    protected function _toArray(QueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->setTable($this->getTable());
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->getParameters());

        $result = $statement->fetchAll(PDO::FETCH_CLASS, $this->getType());
        $statement->closeCursor();

        return $result;
    }

    /**
     * Fetch first result
     * @param QueryBuilder $sqlQueryBuilder
     * @return Entity
     * @throws InvalidOperationException If entity is null
     */
    protected function _first(QueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->setTable($this->getTable());
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->getParameters());

        $result = $statement->fetchObject($this->getType());
        $statement->closeCursor();

        if ($result !== false)
        {
            return $result;
        }
        else
        {
            throw new InvalidOperationException('Entity not found');
        }
    }

    /**
     * Fetch first result or null if not exists
     * @param QueryBuilder $sqlQueryBuilder
     * @return null|Entity
     */
    protected function _firstOrDefault(QueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->setTable($this->getTable());
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->getParameters());

        $result = $statement->fetchObject($this->getType());
        $statement->closeCursor();

        if ($result !== false)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }

    /**
     * Fetch single result
     * @param QueryBuilder $sqlQueryBuilder
     * @return Entity
     * @throws InvalidOperationException If entity is null or there are more than 1 results
     */
    protected function _single(QueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->setTable($this->getTable());
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->getParameters());

        $result = $statement->fetchObject($this->getType());
        $isSingle = $statement->fetch() === false;
        $statement->closeCursor();

        if ($isSingle)
        {
            if ($result !== false)
            {
                return $result;
            }
            else
            {
                throw new InvalidOperationException('Entity not found');
            }
        }
        else
        {
            throw new InvalidOperationException('More than 1 entity found');
        }
    }

    /**
     * Fetch single result or null if entity is null or there are more than 1 results
     * @param QueryBuilder $sqlQueryBuilder
     * @return null|Entity
     */
    protected function _singleOrDefault(QueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->setTable($this->getTable());
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->getParameters());

        $result = $statement->fetchObject($this->getType());
        $isSingle = $statement->fetch() === false;
        $statement->closeCursor();

        if ($isSingle && $result !== false)
        {
            return $result;
        }
        else
        {
            return null;
        }
    }
}
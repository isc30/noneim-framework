<?php

/**
 * Repository
 * @package Modules\Orm
 * @subpackage Models\BusinessObjects
 */
abstract class ReadOnlyRepository
{
    /** @var IConnectionContainer */
    private $_connectionContainer;

    /**
     * Repository Constructor
     * @param IConnectionContainer $connectionContainer
     */
    public function __construct(
        IConnectionContainer $connectionContainer
    ) {
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
     * @return IEntity TODO: Change 'IEntity' to native type
     */
    public abstract function getById($id);

    /**
     * Fetch results to array
     * TODO: return parent::_toArray($queryBuilder);
     * @param SqlQueryBuilder $queryBuilder
     * @return IEntity TODO: Change 'IEntity' to native type
     */
    public abstract function toArray(SqlQueryBuilder $queryBuilder);

    /**
     * Fetch first result
     * TODO: return parent::_first($queryBuilder);
     * @param SqlQueryBuilder $queryBuilder
     * @return IEntity TODO: Change 'IEntity' to native type
     */
    public abstract function first(SqlQueryBuilder $queryBuilder);

    /**
     * Fetch first result or null if not exists
     * TODO: return parent::_firstOrDefault($queryBuilder);
     * @param SqlQueryBuilder $queryBuilder
     * @return IEntity TODO: Change 'IEntity' to native type
     */
    public abstract function firstOrDefault(SqlQueryBuilder $queryBuilder);

    /**
     * Fetch single result
     * TODO: return parent::_single($queryBuilder);
     * @param SqlQueryBuilder $queryBuilder
     * @return IEntity TODO: Change 'IEntity' to native type
     */
    public abstract function single(SqlQueryBuilder $queryBuilder);

    /**
     * Fetch single result or null if entity is null or there are more than 1 results
     * TODO: return parent::_singleOrDefault($queryBuilder);
     * @param SqlQueryBuilder $queryBuilder
     * @return IEntity TODO: Change 'IEntity' to native type
     */
    public abstract function singleOrDefault(SqlQueryBuilder $queryBuilder);

    /**
     * Fetch by id
     * @param int $id
     * @return IEntity
     */
    protected function _getById($id)
    {
        $queryBuilder = new SqlQueryBuilder();
        $queryBuilder->get()->where('id = :id', array('id' => $id));
        return $this->_single($queryBuilder);
    }

    /**
     * Fetch results to array
     * @param SqlQueryBuilder $sqlQueryBuilder
     * @return IEntity[]
     */
    protected function _toArray(SqlQueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->type = 'SELECT';
        $sqlQueryBuilder->table = $this->getTable();
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->input);

        $result = $statement->fetchAll(PDO::FETCH_CLASS, $this->getType());
        $statement->closeCursor();

        return $result;
    }

    /**
     * Fetch first result
     * @param SqlQueryBuilder $sqlQueryBuilder
     * @return IEntity
     * @throws InvalidOperationException If entity is null
     */
    protected function _first(SqlQueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->type = 'SELECT';
        $sqlQueryBuilder->table = $this->getTable();
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->input);

        $result = $statement->fetchObject($this->classType);
        $statement->closeCursor();

        if ($result !== false)
        {
            return $result;
        }
        else
        {
            throw new InvalidOperationException('Entity is null');
        }
    }

    /**
     * Fetch first result or null if not exists
     * @param SqlQueryBuilder $sqlQueryBuilder
     * @return null|IEntity
     */
    protected function _firstOrDefault(SqlQueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->type = 'SELECT';
        $sqlQueryBuilder->table = $this->getTable();
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->input);

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
     * @param SqlQueryBuilder $sqlQueryBuilder
     * @return IEntity
     * @throws InvalidOperationException If entity is null or there are more than 1 results
     */
    protected function _single(SqlQueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->type = 'SELECT';
        $sqlQueryBuilder->table = $this->getTable();
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->input);

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
                throw new InvalidOperationException('Entity is null');
            }
        }
        else
        {
            throw new InvalidOperationException('More than 1 row found');
        }
    }

    /**
     * Fetch single result or null if entity is null or there are more than 1 results
     * @param SqlQueryBuilder $sqlQueryBuilder
     * @return null|IEntity
     */
    protected function _singleOrDefault(SqlQueryBuilder $sqlQueryBuilder)
    {
        $sqlQueryBuilder->type = 'SELECT';
        $sqlQueryBuilder->table = $this->getTable();
        $statement = $this->_connectionContainer->PDO()->prepare($sqlQueryBuilder->getQuery());
        $statement->execute($sqlQueryBuilder->input);

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
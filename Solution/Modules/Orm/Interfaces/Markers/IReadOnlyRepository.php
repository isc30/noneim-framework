<?php

/**
 * ReadOnlyRepository Interface
 */
interface IReadOnlyRepository
{
    /**
     * Fetch by id
     * TODO: return parent::_getById($id);
     * @param int $id
     * @return Entity TODO: Change 'Entity' to native type
     */
    public function getById($id);

    /**
     * Fetch results to array
     * TODO: return parent::_toArray($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity[] TODO: Change 'Entity' to native type
     */
    public function toArray(QueryBuilder $queryBuilder);

    /**
     * Fetch first result
     * TODO: return parent::_first($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity TODO: Change 'Entity' to native type
     */
    public function first(QueryBuilder $queryBuilder);

    /**
     * Fetch first result or null if not exists
     * TODO: return parent::_firstOrDefault($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return null|Entity TODO: Change 'Entity' to native type
     */
    public function firstOrDefault(QueryBuilder $queryBuilder);

    /**
     * Fetch single result
     * TODO: return parent::_single($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return Entity TODO: Change 'Entity' to native type
     */
    public function single(QueryBuilder $queryBuilder);

    /**
     * Fetch single result or null if entity is null or there are more than 1 results
     * TODO: return parent::_singleOrDefault($queryBuilder);
     * @param QueryBuilder $queryBuilder
     * @return null|Entity TODO: Change 'Entity' to native type
     */
    public function singleOrDefault(QueryBuilder $queryBuilder);
}
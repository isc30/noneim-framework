<?php

/**
 * Application
 * @package Application
 * @subpackage Repositories
 */
class NoticiaRepository extends Repository implements INoticiaRepository
{
    /** @return string */
    protected function getType()
    {
        return 'Noticia';
    }

    /** @return string */
    protected function getTable()
    {
        return 'Noticia';
    }

    /**
     * Fetch by id
     * @param int $id
     * @return Noticia
     */
    public function getById($id)
    {
        return parent::_getById($id);
    }

    /**
     * Fetch results to array
     * @param QueryBuilder $queryBuilder
     * @return Noticia[]
     */
    public function toArray(QueryBuilder $queryBuilder)
    {
        return parent::_toArray($queryBuilder);
    }

    /**
     * Fetch first result
     * @param QueryBuilder $queryBuilder
     * @return Noticia
     */
    public function first(QueryBuilder $queryBuilder)
    {
        return parent::_first($queryBuilder);
    }

    /**
     * Fetch first result or null if not exists
     * @param QueryBuilder $queryBuilder
     * @return null|Noticia
     */
    public function firstOrDefault(QueryBuilder $queryBuilder)
    {
        return parent::_firstOrDefault($queryBuilder);
    }

    /**
     * Fetch single result
     * @param QueryBuilder $queryBuilder
     * @return string
     */
    public function single(QueryBuilder $queryBuilder)
    {
        return parent::_single($queryBuilder);
    }

    /**
     * Fetch single result or null if entity is null or there are more than 1 results
     * @param QueryBuilder $queryBuilder
     * @return null|Noticia
     */
    public function singleOrDefault(QueryBuilder $queryBuilder)
    {
        return parent::_singleOrDefault($queryBuilder);
    }

    /**
     * @param Noticia $entity
     * @throws Exception
     */
    public function add($entity)
    {
        return parent::_add($entity);
    }

    /**
     * @param Noticia $entity
     * @throws Exception
     */
    public function edit($entity)
    {
        return parent::_edit($entity);
    }

    /**
     * @param Noticia $entity
     * @throws Exception
     */
    public function delete($entity)
    {
        return parent::_delete($entity);
    }
}
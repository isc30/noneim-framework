<?php

/**
 * Created by PhpStorm.
 * User: black
 * Date: 01/10/2016
 * Time: 13:36
 */
interface INoticiaRepository extends IRepository
{
    /**
     * Fetch by id
     * @param int $id
     * @return Noticia
     */
    public function getById($id);

    /**
     * Fetch results to array
     * @param QueryBuilder $queryBuilder
     * @return Noticia[]
     */
    public function toArray(QueryBuilder $queryBuilder);

    /**
     * Fetch first result
     * @param QueryBuilder $queryBuilder
     * @return Noticia
     */
    public function first(QueryBuilder $queryBuilder);

    /**
     * Fetch first result or null if not exists
     * @param QueryBuilder $queryBuilder
     * @return null|Noticia
     */
    public function firstOrDefault(QueryBuilder $queryBuilder);

    /**
     * Fetch single result
     * @param QueryBuilder $queryBuilder
     * @return Noticia
     */
    public function single(QueryBuilder $queryBuilder);

    /**
     * Fetch single result or null if entity is null or there are more than 1 results
     * @param QueryBuilder $queryBuilder
     * @return null|Noticia
     */
    public function singleOrDefault(QueryBuilder $queryBuilder);

    /**
     * @param Noticia $entity
     * @throws Exception
     */
    public function add($entity);

    /**
     * @param Noticia $entity
     * @throws Exception
     */
    public function edit($entity);

    /**
     * @param Noticia $entity
     * @throws Exception
     */
    public function delete($entity);
}
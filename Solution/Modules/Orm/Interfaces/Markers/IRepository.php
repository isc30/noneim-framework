<?php

/**
 * Repository Interface
 */
interface IRepository extends IReadOnlyRepository
{
    /**
     * @param Entity $entity
     * @throws Exception
     */
    public function add(Entity $entity);

    /**
     * @param Entity $entity
     * @throws Exception
     */
    public function edit(Entity $entity);

    /**
     * @param Entity $entity
     * @throws Exception
     */
    public function delete(Entity $entity);
}
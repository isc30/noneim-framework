<?php

interface IRepository extends IReadOnlyRepository
{
    /**
     * @param Entity $entity
     * @throws Exception
     */
    public function add($entity);

    /**
     * @param Entity $entity
     * @throws Exception
     */
    public function edit($entity);

    /**
     * @param Entity $entity
     * @throws Exception
     */
    public function delete($entity);
}
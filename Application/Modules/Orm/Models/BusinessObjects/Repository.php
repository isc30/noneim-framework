<?php

/**
 * Repository
 * @package Modules\Orm
 * @subpackage Models\BusinessObjects
 */
abstract class Repository extends ReadonlyRepository
{
    /**
     * TODO: return parent::_add($entity);
     * @param IEntity $entity TODO: Change 'IEntity' to native type
     * @throws Exception
     */
    public abstract function add($entity);

    /**
     * TODO: return parent::_edit($entity);
     * @param IEntity $entity TODO: Change 'IEntity' to native type
     * @throws Exception
     */
    public abstract function edit($entity);

    /**
     * TODO: return parent::_delete($entity);
     * @param IEntity $entity TODO: Change 'IEntity' to native type
     * @throws Exception
     */
    public abstract function delete($entity);

    /**
     * @param IEntity $entity
     * @throws Exception
     */
    protected function _add(IEntity $entity)
    {
        if (!Configuration::debug || (is_object($entity) && get_class($entity) === $this->getType()))
        {
            echo '<p>Adding</p>';
        }
        else
        {
            throw new Exception('Entity type error. Expected ' . $this->getType());
        }
    }

    /**
     * @param IEntity $entity
     * @throws Exception
     */
    protected function _edit(IEntity $entity)
    {
        if (!Configuration::debug || (is_object($entity) && get_class($entity) === $this->getType()))
        {
            echo '<p>Editing</p>';
        }
        else
        {
            throw new Exception('Entity type error. Expected ' . $this->getType());
        }
    }

    /**
     * @param IEntity $entity
     * @throws Exception
     */
    protected function _delete(IEntity $entity)
    {
        if (!Configuration::debug || (is_object($entity) && get_class($entity) === $this->getType()))
        {
            echo '<p>Deleting</p>';
        }
        else
        {
            throw new Exception('Entity type error. Expected ' . $this->getType());
        }
    }
}
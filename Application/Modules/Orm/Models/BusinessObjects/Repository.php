<?php

/**
 * Repository
 * @package Modules\Orm
 * @subpackage Models\BusinessObjects
 */
abstract class Repository extends ReadOnlyRepository
{
    /**
     * TODO: return parent::_add($entity);
     * @param Entity $entity TODO: Change 'Entity' to native type
     * @throws Exception
     */
    public abstract function add($entity);

    /**
     * TODO: return parent::_edit($entity);
     * @param Entity $entity TODO: Change 'Entity' to native type
     * @throws Exception
     */
    public abstract function edit($entity);

    /**
     * TODO: return parent::_delete($entity);
     * @param Entity $entity TODO: Change 'Entity' to native type
     * @throws Exception
     */
    public abstract function delete($entity);

    /**
     * @param Entity $entity
     * @throws Exception
     */
    protected function _add(Entity $entity)
    {
        if (!Configuration::debug || (is_object($entity) && get_class($entity) === $this->getType()))
        {
            // Get values
            $reflectionClass = new ReflectionClass($this->getType());
            $entityProperties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);
            $values = array();

            foreach ($entityProperties as $property)
            {
                $propertyName = strtolower($property->getName());
                if ($entity->id !== null || ($entity->id === null && $propertyName !== 'id'))
                {
                    $values[$propertyName] = $entity->{$propertyName};
                }
            }

            // Query
            $insertQuery = array();
            $insertQuery[] = 'INSERT INTO';
            $insertQuery[] = "`{$this->getTable()}`";

            if ($entity->id !== null)
            {
                $insertQuery[] = '(`' . implode('`,`', array_keys($values)) . '`)';
                $insertQuery[] = "VALUES";
                $insertQuery[] = '(:' . implode(',:', array_keys($values)) . ')';
            }
            else
            {
                $insertQuery[] = '(`id`,`' . implode('`,`', array_keys($values)) . '`)';
                $insertQuery[] = "SELECT";
                $insertQuery[] = "MAX(`id`)+1,:" . implode(',:', array_keys($values)); // Auto increment id
                $insertQuery[] = "FROM `{$this->getTable()}`";
            }

            $statement = $this->_connectionContainer->PDO()->prepare(implode(' ', $insertQuery));
            $statement->execute($values);
        }
        else
        {
            throw new Exception('Entity type error. Expected ' . $this->getType());
        }
    }

    /**
     * @param Entity $entity
     * @throws Exception
     */
    protected function _edit(Entity $entity)
    {
        if (!Configuration::debug || (is_object($entity) && get_class($entity) === $this->getType()))
        {
            if ($entity->id !== null)
            {
                // Get values
                $reflectionClass = new ReflectionClass($this->getType());
                $entityProperties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);
                $values = array();

                foreach ($entityProperties as $property)
                {
                    $propertyName = strtolower($property->getName());
                    $values[$propertyName] = $entity->{$propertyName};
                }

                // Query
                $insertQuery = array();
                $insertQuery[] = 'UPDATE';
                $insertQuery[] = "`{$this->getTable()}`";

                $set = array();
                foreach ($values as $key => $value)
                {
                    if ($key !== 'id')
                    {
                        $set[] = "`{$key}`=:{$key}";
                    }
                }

                $insertQuery[] = 'SET';
                $insertQuery[] = implode(',', $set);

                $insertQuery[] = 'WHERE';
                $insertQuery[] = '`id`=:id';

                $statement = $this->_connectionContainer->PDO()->prepare(implode(' ', $insertQuery));
                $statement->execute($values);
            }
            else
            {
                throw new Exception('Entity error. Id can\'t be null');
            }
        }
        else
        {
            throw new Exception('Entity type error. Expected ' . $this->getType());
        }
    }

    /**
     * @param Entity $entity
     * @throws Exception
     */
    protected function _delete(Entity $entity)
    {
        if (!Configuration::debug || (is_object($entity) && get_class($entity) === $this->getType()))
        {
            if ($entity->id !== null)
            {
                // Query
                $insertQuery = array();
                $insertQuery[] = 'DELETE FROM';
                $insertQuery[] = "`{$this->getTable()}`";
                $insertQuery[] = 'WHERE';
                $insertQuery[] = '`id`=:id';

                $statement = $this->_connectionContainer->PDO()->prepare(implode(' ', $insertQuery));
                $statement->execute(array('id' => $entity->id));
            }
            else
            {
                throw new Exception('Entity error. Id can\'t be null');
            }
        }
        else
        {
            throw new Exception('Entity type error. Expected ' . $this->getType());
        }
    }
}
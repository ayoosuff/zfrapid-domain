<?php
/**
 * ZF2rapid domain
 *
 * @package    ZFrapidDomain
 * @link       https://github.com/ZFrapid/zf2rapid-domain
 * @copyright  Copyright (c) 2015 - 2016 Ralf Eggert
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 */

/**
 * namespace definition and usage
 */
namespace ZFrapidDomain\Storage;

use Zend\Db\TableGateway\Exception\RuntimeException;
use Zend\Db\TableGateway\TableGateway;
use Zend\Hydrator\HydratorInterface;
use ZFrapidDomain\Entity\EntityInterface;
use ZFrapidDomain\TableGateway\TableGatewayInterface;

/**
 * Class AbstractStorage
 *
 * @package ZFrapidDomain\Storage
 */
abstract class AbstractStorage implements StorageInterface
{
    /**
     * @var TableGatewayInterface|TableGateway
     */
    private $tableGateway;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * AbstractStorage constructor.
     *
     * @param TableGatewayInterface $tableGateway
     * @param HydratorInterface     $hydrator
     */
    public function __construct(
        TableGatewayInterface $tableGateway, HydratorInterface $hydrator
    ) {
        $this->tableGateway = $tableGateway;
        $this->hydrator     = $hydrator;
    }

    /**
     * Fetch all entities
     *
     * @return array
     */
    public function fetchAllEntities()
    {
        $select = $this->tableGateway->getSql()->select();

        return $this->tableGateway->fetchCollection($select);
    }

    /**
     * Fetch entity by id
     *
     * @param $id
     *
     * @return mixed
     */
    public function fetchEntityById($id)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->where->equalTo($this->tableGateway->getPrimaryKey(), $id);

        return $this->tableGateway->fetchEntity($select);
    }

    /**
     * Insert an new entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function insertEntity(EntityInterface $entity)
    {
        $insert = $this->tableGateway->getSql()->insert();
        $insert->values($this->hydrator->extract($entity));

        try {
            $this->tableGateway->insertWith($insert);
        } catch (RuntimeException $e) {
            return false;
        }

        return true;
    }

    /**
     * Update an existing entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function updateEntity(EntityInterface $entity)
    {
        $update = $this->tableGateway->getSql()->update();
        $update->set($this->hydrator->extract($entity));
        $update->where->equalTo(
            $this->tableGateway->getPrimaryKey(), $entity->getIdentifier()
        );

        try {
            $this->tableGateway->updateWith($update);
        } catch (RuntimeException $e) {
            return false;
        }

        return true;
    }

    /**
     * Delete an existing entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function deleteEntity(EntityInterface $entity)
    {
        $delete = $this->tableGateway->getSql()->delete();
        $delete->where->equalTo(
            $this->tableGateway->getPrimaryKey(), $entity->getIdentifier()
        );

        try {
            $this->tableGateway->deleteWith($delete);
        } catch (RuntimeException $e) {
            return false;
        }

        return true;
    }
}
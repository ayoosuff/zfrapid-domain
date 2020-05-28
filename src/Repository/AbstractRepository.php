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
namespace ZFrapidDomain\Repository;

use ZFrapidDomain\Entity\EntityInterface;
use ZFrapidDomain\Storage\StorageInterface;

/**
 * Class AbstractRepository
 *
 * @package ZFrapidDomain\Repository
 */
abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * AbstractRepository constructor.
     *
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * Get all entities from table
     *
     * @return array
     */
    public function getAllEntities()
    {
        return $this->storage->fetchAllEntities();
    }

    /**
     * Get entity by id from table
     *
     * @param $id
     *
     * @return mixed
     */
    public function getEntityById($id)
    {
        return $this->storage->fetchEntityById($id);
    }

    /**
     * Save an entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function saveEntity(EntityInterface $entity)
    {
        $check = $this->storage->fetchEntityById($entity->getIdentifier());

        if ($check) {
            return $this->storage->updateEntity($entity);
        } else {
            return $this->storage->insertEntity($entity);
        }
    }

    /**
     * Delete an entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function removeEntity(EntityInterface $entity)
    {
        return $this->storage->deleteEntity($entity);
    }
}
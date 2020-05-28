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

/**
 * Class AbstractRepository
 *
 * @package ZFrapidDomain\Repository
 */
interface RepositoryInterface
{
    /**
     * Get all entities from table
     *
     * @return array
     */
    public function getAllEntities();

    /**
     * Get entity by id from table
     *
     * @param $id
     *
     * @return mixed
     */
    public function getEntityById($id);

    /**
     * Save an entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function saveEntity(EntityInterface $entity);

    /**
     * Delete an entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function removeEntity(EntityInterface $entity);
}
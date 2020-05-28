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

use ZFrapidDomain\Entity\EntityInterface;

/**
 * Interface StorageInterface
 *
 * @package ZFrapidDomain\Storage
 */
interface StorageInterface
{
    /**
     * Fetch all entities
     *
     * @return EntityInterface[]
     */
    public function fetchAllEntities();

    /**
     * Fetch entity by id
     *
     * @param $id
     *
     * @return EntityInterface
     */
    public function fetchEntityById($id);

    /**
     * Insert an new entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function insertEntity(EntityInterface $entity);

    /**
     * Update an existing entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function updateEntity(EntityInterface $entity);

    /**
     * Delete an existing entity
     *
     * @param EntityInterface $entity
     *
     * @return bool
     */
    public function deleteEntity(EntityInterface $entity);
}
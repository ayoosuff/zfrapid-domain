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
namespace ZFrapidDomain\Entity;

/**
 * Interface EntityInterface
 *
 * @package ZFrapidDomain\Entity
 */
interface EntityInterface
{
    /**
     * Get the primary identifier
     *
     * @return mixed
     */
    public function getIdentifier();
}

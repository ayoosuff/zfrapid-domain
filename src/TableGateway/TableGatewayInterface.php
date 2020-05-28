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
namespace ZFrapidDomain\TableGateway;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGatewayInterface as ZendTableGatewayInterface;

/**
 * Interface TableGatewayInterface
 *
 * @package ZFrapidDomain\TableGateway
 */
interface TableGatewayInterface extends ZendTableGatewayInterface
{
    /**
     * Get the primary key name
     *
     * @return string
     */
    public function getPrimaryKey();

    /**
     * Fetch array collection of entities
     *
     * @param Select $select
     *
     * @return array
     */
    public function fetchCollection(Select $select);

    /**
     * Fetch single entity
     *
     * @param Select $select
     *
     * @return mixed
     */
    public function fetchEntity(Select $select);
}

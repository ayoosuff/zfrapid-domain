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

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\ResultSet\ResultSetInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\TableGateway\TableGateway;
use ZFrapidDomain\Entity\EntityInterface;

/**
 * Class AbstractTableGateway
 *
 * @package ZFrapidDomain\TableGateway
 */
abstract class AbstractTableGateway extends TableGateway
    implements TableGatewayInterface
{
    /**
     * @var string
     */
    private $primaryKey = 'id';

    /**
     * AbstractTableGateway constructor.
     *
     * @param string                       $primaryKey
     * @param string|TableIdentifier|array $table
     * @param AdapterInterface             $adapter
     * @param ResultSetInterface           $resultSetPrototype
     */
    public function __construct(
        $primaryKey,
        $table,
        AdapterInterface $adapter,
        ResultSetInterface $resultSetPrototype
    ) {
        $this->primaryKey = $primaryKey;

        parent::__construct(
            $table, $adapter, null, $resultSetPrototype
        );
    }

    /**
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * Fetch array collection of entities
     *
     * @param Select $select
     *
     * @return array
     */
    public function fetchCollection(Select $select)
    {
        $collection = [];

        /** @var EntityInterface $entity */
        foreach ($this->selectWith($select) as $entity) {
            $collection[$entity->getIdentifier()] = $entity;
        }

        return $collection;
    }

    /**
     * Fetch single entity
     *
     * @param Select $select
     *
     * @return mixed
     */
    public function fetchEntity(Select $select)
    {
        /** @var ResultSet $resultSet */
        $resultSet = $this->selectWith($select);

        return $resultSet->current();
    }
}
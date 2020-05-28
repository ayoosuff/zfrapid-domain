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

use Zend\Filter\StaticFilter;
use Zend\Stdlib\ArraySerializableInterface;

/**
 * Class AbstractEntity
 *
 * @package ZFrapidDomain\Entity
 */
abstract class AbstractEntity
    implements ArraySerializableInterface, EntityInterface
{
    /**
     * Exchange properties with values from array
     *
     * @param array $array
     */
    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            $setMethod = 'set' . StaticFilter::execute(
                    $key, 'WordUnderscoreToCamelCase'
                );

            if (method_exists($this, $setMethod)) {
                $this->$setMethod($value);
            }
        }
    }

    /**
     * Generate an array copy from property values
     */
    public function getArrayCopy()
    {
        $data = [];

        foreach (get_object_vars($this) as $key => $value) {
            $getMethod = 'get' . ucfirst($key);

            $arrayKey = StaticFilter::execute($key, 'WordCamelCaseToUnderscore');
            $arrayKey = StaticFilter::execute($arrayKey, 'StringToLower');

            if (method_exists($this, $getMethod)) {
                $data[$arrayKey] = $this->$getMethod();
            }

        }

        return $data;
    }
}

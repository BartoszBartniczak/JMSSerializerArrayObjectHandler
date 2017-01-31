<?php
/**
 * Created by PhpStorm.
 * User: Bartosz Bartniczak <kontakt@bartoszbartniczak.pl>
 */

namespace BartoszBartniczak\JMSSerializer\ArrayObjectHandler;

use BartoszBartniczak\JMSSerializer\ArrayObjectHandler\Fixtures\User;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\VisitorInterface;

class ArrayObjectHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        $methods = array();
        $formats = array('json', 'xml', 'yml');
        $collectionTypes = array(
            \ArrayObject::class
        );

        foreach ($collectionTypes as $type) {
            foreach ($formats as $format) {
                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'serializeArrayObject'
                );

                $methods[] = array(
                    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                    'type' => $type,
                    'format' => $format,
                    'method' => 'deserializeArrayObject'
                );
            }
        }

        return $methods;
    }

    public function serializeArrayObject(VisitorInterface $visitor, \ArrayObject $arrayObject, array $type, \JMS\Serializer\Context $context)
    {
//        $type['name'] = 'array';
        return $visitor->visitArray($arrayObject->getArrayCopy(), $type, $context);
    }

    public function deserializeArrayObject(\JMS\Serializer\VisitorInterface $visitor, $data, array $type, \JMS\Serializer\Context $context)
    {
//        $type['name'] = 'array<'.User::class.'>';
//        $type['name'] = 'array';
        return new \ArrayObject($visitor->visitArray($data, $type, $context));
    }

}
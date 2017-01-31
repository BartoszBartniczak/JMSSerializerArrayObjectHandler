<?php

namespace BartoszBartniczak\JMSSerializer\ArrayObjectHandler;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;

/**
 * Created by PhpStorm.
 * User: Bartosz Bartniczak <kontakt@bartoszbartniczak.pl>
 */
class TestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var SerializerInterface
     */
    protected $serializer;

    protected function setUp()
    {
        parent::setUp();

        AnnotationRegistry::registerLoader('class_exists');


        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->configureHandlers(
                function (HandlerRegistry $handlerRegistry){
                    $handlerRegistry->registerSubscribingHandler(
                        new ArrayObjectHandler()
                    );
                }
            )
            ->build();
    }

}

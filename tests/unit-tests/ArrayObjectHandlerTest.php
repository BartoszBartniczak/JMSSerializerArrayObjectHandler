<?php
/**
 * Created by PhpStorm.
 * User: Bartosz Bartniczak <kontakt@bartoszbartniczak.pl>
 */

namespace BartoszBartniczak\JMSSerializer\ArrayObjectHandler;


use BartoszBartniczak\JMSSerializer\ArrayObjectHandler\Fixtures\User;

class ArrayObjectHandlerTest extends TestCase
{

    /**
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::serializeArrayObject
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::deserializeArrayObject
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::getSubscribingMethods
     */
    public function testSerializeEmptyObject()
    {
        $arrayObject = new \ArrayObject();

        $data = $this->serializer->serialize($arrayObject, 'json');
        $this->assertSame('[]', $data);
        $this->assertEquals($arrayObject, $this->serializer->deserialize($data, \ArrayObject::class, 'json'));
    }

    /**
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::serializeArrayObject
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::deserializeArrayObject
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::getSubscribingMethods
     */
    public function testSerializeArrayWithIntegerKeys()
    {
        $arrayObject = new \ArrayObject([
            1 => 100,
            2 => 200,
            4 => 400
        ]);

        $data = $this->serializer->serialize($arrayObject, 'json');
        $this->assertSame('{"1":100,"2":200,"4":400}', $data);
        $this->assertEquals($arrayObject, $this->serializer->deserialize($data, \ArrayObject::class, 'json'));
    }

    public function testSerializeArrayWithStringKeys()
    {
        $arrayObject = new \ArrayObject([
            'a' => "Albert",
            'b' => "Bartosz",
            'd' => "Dariusz"
        ]);
        $data = $this->serializer->serialize($arrayObject, 'json');
        $this->assertSame('{"a":"Albert","b":"Bartosz","d":"Dariusz"}', $data);
        $this->assertEquals($arrayObject, $this->serializer->deserialize($data, \ArrayObject::class, 'json'));
    }

    /**
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::serializeArrayObject
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::deserializeArrayObject
     * @covers \BartoszBartniczak\JMSSerializer\ArrayObjectHandler\ArrayObjectHandler::getSubscribingMethods
     */
    public function testSerializeArrayWithObjects()
    {
        $arrayObject = new \ArrayObject(
            [
                'nowicki' => new User('Jan', 'Nowicki'),
                'kowalski' => new User('Andrzej', 'Kowalski')
            ]
        );

        $data = $this->serializer->serialize($arrayObject, 'json');
        $this->assertSame('{"nowicki":{"first_name":"Jan","last_name":"Nowicki"},"kowalski":{"first_name":"Andrzej","last_name":"Kowalski"}}', $data);
        $this->assertEquals($arrayObject, $this->serializer->deserialize($data, \ArrayObject::class.'<'.User::class.'>', 'json'));

        $this->markTestIncomplete();
    }

    public function testSerializeArrayWithDateTimeObjects()
    {
        $this->markTestIncomplete();
    }

}

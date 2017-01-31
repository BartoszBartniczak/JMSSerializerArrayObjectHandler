<?php
/**
 * Created by PhpStorm.
 * User: Bartosz Bartniczak <kontakt@bartoszbartniczak.pl>
 */

namespace BartoszBartniczak\JMSSerializer\ArrayObjectHandler\Fixtures;

use JMS\Serializer\Annotation\Type;

class User
{

    /**
     * @var string
     * @Type("string")
     */
    private $firstName;

    /**
     * @var string
     * @Type("string")
     */
    private $lastName;

    /**
     * User constructor.
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($firstName, $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

}
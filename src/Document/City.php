<?php

declare(strict_types = 1);

namespace App\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="cities")
 */
class City
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(name="cityName", type="string")
     */
    private $name;

    /**
     * @ODM\Field(name="indexNumber", type="int")
     */
    private $index;

    /**
     * @ODM\ReferenceMany(
     *     targetDocument="User"
     * )
     */
    private $users;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function setIndex(string $index): void
    {
        $this->index = $index;
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function addUser(User $user): void
    {
        $this->users[] = $user;
    }
}
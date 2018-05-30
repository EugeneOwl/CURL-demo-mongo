<?php

declare(strict_types = 1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * @ODM\Document(collection="users")
 */
class User implements UserInterface
{
    public function __construct($username, $password, $cityName)
    {
        $this->username = $username;
        $this->password = $password;
        $this->cityName = $cityName;
    }

    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $username;

    /**
     * @ODM\Field(type="string")
     */
    private $password;

    private $plainPassword;

    /**
     * @ODM\Field(type="string")
     */
    private $cityName;

    private $plainCityName;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function setCityName(string $cityName): void
    {
        $this->cityName = $cityName;
    }

    public function getPlainCityName(): ?string
    {
        return $this->plainCityName;
    }

    public function setPlainCityName(string $plainCityName): void
    {
        $this->plainCityName = $plainCityName;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getRoles()
    {
        return ["ROLE_USER"];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }
}
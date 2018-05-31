<?php

declare(strict_types = 1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ODM\Document(
 *     repositoryClass="App\Repository\UserRepository",
 *     collection="users"
 * )
 */
class User implements UserInterface
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @ODM\Field(type="string")
     */
    private $password;

    /**
     * @Assert\NotBlank()
     */
    private $plainPassword;

    /**
     * @ODM\Field(type="string")
     */
    private $cityName;

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
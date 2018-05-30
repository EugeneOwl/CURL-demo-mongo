<?php

namespace App\Security\User;


use App\Document\User;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\Controller\mongoTest;

class WebserviceUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $userData = new User("Eugene", '$2y$13$GshoJMu/9ovjaTxZnyWwDeQssVs4AzF8Nnxea1/dtqKAbPflmegYS', "Минск");
        // pretend it returns an array on success, false if there is no user

        if ($userData) {
            $password = '$2y$13$GshoJMu/9ovjaTxZnyWwDeQssVs4AzF8Nnxea1/dtqKAbPflmegYS';

            $cityName = "Минск";

            return new User($username, $password, $cityName);
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }
}
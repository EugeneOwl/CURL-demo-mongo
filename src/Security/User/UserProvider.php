<?php

namespace App\Security\User;


use App\Document\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserProvider implements UserProviderInterface
{
    public function loadUserByUsername($username)
    {
        $userData = "data";// Из БД я бы достал правильный хэщ пароля и внизу бы его передал
        // TODO найти способ доставать репозиторием нужный экземпляр по логину
        // и далее его пароль передавать сдесь же
        if ($userData) {
            $password = '$2y$13$GshoJMu/9ovjaTxZnyWwDeQssVs4AzF8Nnxea1/dtqKAbPflmegYS';
            $cityName = "Минск";
            $username = "Eugene";

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
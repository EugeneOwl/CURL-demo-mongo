<?php

namespace App\Security\User;


use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;

class UserProvider extends Controller implements UserProviderInterface
{
    private function getUserByUsername($username)
    {
        $user = new User();
        $user->setPassword('$2y$13$GshoJMu/9ovjaTxZnyWwDeQssVs4AzF8Nnxea1/dtqKAbPflmegYS');
        $user->setCityName("Миснк");
        $user->setUsername($username);
        $me = new UserProvider();
        $me->get('doctrine_mongodb.odm.default_connection')->getManager;
        return $user;
    }

    public function loadUserByUsername($username)
    {
        $userData = $this->getUserByUsername($username);
        if ($userData) {
            $user = $userData;
            return $user;
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
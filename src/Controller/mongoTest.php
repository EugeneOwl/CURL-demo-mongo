<?php

namespace App\Controller;


use App\Document\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class mongoTest extends Controller
{
    /**
     * @Route("/mongoTest")
     */
    public function mongoTest()
    {
        $user = new User();
        $user->setEmail("hello@medium.com");
        $user->setFirstname("Matt3");
        $user->setLastname("Matt3");
        $user->setPassword(md5("123456"));
        $dm = $this->get('doctrine_mongodb')->getManager();

        $dm->persist($user);
        $dm->flush();
        return new Response("ok.");
    }
}
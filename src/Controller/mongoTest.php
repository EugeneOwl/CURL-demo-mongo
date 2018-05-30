<?php

namespace App\Controller;


use App\Document\User;
use App\Document\City;
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
        $this->test();
        //$this->create();
        return new Response("ok.");
    }

    private function create(): void
    {
        $user = new User();
        $user->setUsername("Eugene");
        $user->setPassword(md5("123456"));

        $user2 = new User();
        $user2->setUsername("Victoria");
        $user2->setPassword(md5("123456"));

        $city = new City();
        $city->setIndex(1234567);
        $city->setName("Minsk");

        $user->setCityName($city->getName());
        $user2->setCityName($city->getName());

        $city->addUser($user);
        $city->addUser($user2);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($user);
        $dm->persist($user2);
        $dm->persist($city);
        $dm->flush();
    }

    private function test(): void
    {
        $doctrineManager = $this->get("doctrine_mongodb")->getManager();
        $neededCity = $doctrineManager->getRepository(City::class)->findOneBy(["name" => "Minsk"]);
        $neededUsers = $doctrineManager->getRepository(User::class)->findBy(["cityName" => $neededCity->getName()]);
        //var_dump($neededCity);
        var_dump($neededUsers);
    }
}
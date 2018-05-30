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

        $city = new City();
        $city->setIndex(1234567);
        $city->setName("Минск");

        $user->setCity($city);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($user);
        $dm->persist($city);
        $dm->flush();
    }

    private function test(): void
    {
        $doctrineManager = $this->get("doctrine_mongodb")->getManager();
        $neededCity = $doctrineManager->getRepository(City::class)->findOneBy(["name" => "Минск"]);
        $neededUser = $doctrineManager->getRepository(User::class)->findOneBy(["city" => $neededCity]);
        var_dump($neededCity);
        var_dump($neededUser);
    }
}
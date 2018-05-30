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
        //$this->test();
        //$this->create();
        return new Response("ok.");
    }

    public function findUser(string $username): ?User
    {
        $dm = $this->get("doctrine_mongodb")->getManager();
        return $dm->getRepository(User::class)->findOneBy(["username" => $username]);
    }

    private function create(): void
    {
        $user = new User();
        $user->setUsername("Eugene");
        $user->setPassword(md5("password"));

        $city = new City();
        $city->setIndex(26850);
        $city->setName("Минск");

        $user->setCityName($city->getName());

        $city->addUser($user);

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($user);
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
<?php

namespace App\Controller;


use App\Document\City;
use App\Form\CitySearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="app_home")
     */
    public function run(Request $request): Response
    {
        $city = new City();
        $form = $this->createForm(CitySearchType::class, $city);
        $cityRepo = $this->get("doctrine_mongodb")->getManager()->getRepository(City::class);

        $userList = [];
        $doesCityExist = true;

        $form->handleRequest($request);
        if (
            $form->isSubmitted() &&
            $form->isValid() &&
            $doesCityExist = $cityRepo->doesCityExist($city->getName())
        ) {
            $searchCity = $cityRepo->findOneBy(["name" => $city->getName()]);
            //var_dump($searchCity->getUsers());
            $userList = $searchCity->getUsers();
        }
        return $this->render("home.html.twig", [
            "title"        => "home",
            "header"       => "Welcome, " . $this->getUser()->getUsername(),
            "searchForm"   => $form->createView(),
            "city_message" => $doesCityExist ? "" : "City not found.",
            "userList"     => $userList,
        ]);
    }
}
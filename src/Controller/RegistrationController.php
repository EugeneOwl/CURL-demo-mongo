<?php

declare(strict_types = 1);

namespace App\Controller;


use App\Document\City;
use App\Document\User;
use App\Form\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    /**
     * @Route("/registration", name="app_registration")
     */
    public function run(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $userRepo = $this->get("doctrine_mongodb")->getManager()->getRepository(User::class);
        $cityRepo = $this->get("doctrine_mongodb")->getManager()->getRepository(City::class);

        $isUsernameFree = true;
        $doesCityExist = true;

        $form->handleRequest($request);
        if (
            $form->isSubmitted() &&
            $form->isValid() &&
            $isUsernameFree = $userRepo->isUsernameFree($user->getUsername()) &&
            $doesCityExist = $cityRepo->doesCityExist($user->getCityName())
        ) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $doctrineManager = $this->get("doctrine_mongodb")->getManager();
            $doctrineManager->persist($user);
            $doctrineManager->flush();
            return $this->redirectToRoute("app_home");
        }
        return $this->render("registration.html.twig", [
            "title" => "log up",
            "header" => "Registration",
            "username_message" => $isUsernameFree ? "" : "Username is already taken.",
            "city_message" => $doesCityExist ? "" : "City not found.",
            "form" => $form->createView(),
        ]);
    }
}
<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\TextType;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class BaseController extends AbstractController
{
    /**
     * @Route("/", name="")
     * @param ManagerRegistry $reg
     * @return Response
     */
    public function index(ManagerRegistry $reg): Response
    {
        $userRepo = new UserRepository($reg);
        $users = $userRepo->findAll();

        return $this->render("base/home.html.twig",['users'=>$users]);
    }


    /**
     * @Route("/user-add",name="add_user")
     * @param ManagerRegistry $reg
     * @param User|null $user
     * @param Request $request
     * @return Response
     * @internal
     */
    public function addUser(ManagerRegistry $reg,?User $user,Request $request): Response

    {
        $form = $this->createForm(UserFormType::class, $user);

        if($request->getRequestMethod()== "POST" )
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $userRepo = new UserRepository($reg);
            $userRepo->add($user);
            return $this->redirectToRoute("user_register_success");
        }
        return $this->redirectToRoute("add_user",['form'=>$form->createView()]);
    }




    /**
     * @Route("user-register-success",name="user_register_success")
     */
    public function UserSuccessfullRegistration(): Response{
        return $this->redirectToRoute("",['messages'=>"user ssucessfully registered"]);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->render('user/index.html.twig', [
                'users' => $userRepository->findAll(),
            ]);
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('user_index');
            }

            return $this->render('user/new.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->render('user/show.html.twig', [
                'user' => $user,
            ]);
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('user_index');
            }

            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
            if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($user);
                $entityManager->flush();
            }

            return $this->redirectToRoute('home');
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }
}
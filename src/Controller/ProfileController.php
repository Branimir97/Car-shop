<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class ProfileController
 * @package App\Controller
 * @Route("/profile")
 * @IsGranted("ROLE_USER")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/", name="user_profile")
     * @return Response
     */
    public function index()
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController'
        ]);
    }

    /**
     * @Route("/change_password", name="password_change")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function changePassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user_id = $this->getUser();
        $user = $this->getDoctrine()->getRepository(User::class)->find($user_id);

        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        /** @var User $user */
        if($this->getUser() && $form->isSubmitted() && $form->isValid())
        {
            $current_password = $form->get('current_password')->getData();
            $user_password = $passwordEncoder->isPasswordValid($user, $current_password);
            if(!$user_password)
            {
                $this->addFlash('warning', 'Wrong current password.');

            } else
            {
                $new_password = $form->get('password')->get('first')->getData();
                $user->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $new_password
                ));

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Password changed.');
                return $this->redirectToRoute('user_profile');
            }
        }
        return $this->render('profile/change_password.html.twig', [
            'controller_name' => 'ProfileController',
            'changePasswordForm' => $form->createView()
        ]);
    }
}

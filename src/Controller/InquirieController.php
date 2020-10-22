<?php

namespace App\Controller;

use App\Form\InquirieFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InquirieController extends AbstractController
{
    /**
     * @Route("/inquirie/{id}/create", name="inquirie_create")
     */
    public function index()
    {
        if($this->isGranted('ROLE_USER'))
        {
            $form = $this->createForm(InquirieFormType::class);

            return $this->render('inquirie/index.html.twig', [
                'form' => $form->createView()
            ]);
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }
}

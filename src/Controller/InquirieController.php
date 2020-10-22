<?php

namespace App\Controller;

use App\Entity\Inquirie;
use App\Entity\Vehicle;
use App\Form\InquirieType;
use App\Repository\InquirieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inquirie")
 */
class InquirieController extends AbstractController
{
    /**
     * @Route("/{id}/create", name="inquirie_create", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        if($this->isGranted('ROLE_USER'))
        {
            $inquirie = new Inquirie();
            $form = $this->createForm(InquirieType::class, $inquirie);
            $form->handleRequest($request);
            $vehicle_id = $request->get('id');
            /** @var Vehicle $vehicle */
            $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
            $vehicle_title = $vehicle->getMark().' '.$vehicle->getModel();
            if($form->isSubmitted() && $form->isValid())
            {
                $inquirie->setUser($this->getUser());
                $inquirie->setVehicle($vehicle);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($inquirie);
                $entityManager->flush();

                $vehicle->setStatus('Reserved');
                $entityManager->persist($vehicle);
                $entityManager->flush();

                $this->addFlash('success', 'Thanks for sending us offer for this vehicle. Owner is gonna answer you soon!');
                return $this->redirectToRoute('vehicle_details', ['id'=> $vehicle->getId()]);
            }
            return $this->render('inquirie/index.html.twig', [
                'form' => $form->createView(),
                'vehicle_title' => $vehicle_title
            ]);
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/list", name="inquirie_list", methods={"GET"})
     * @param InquirieRepository $inquirieRepository
     * @return Response
     */
    public function show(InquirieRepository $inquirieRepository): Response
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
            $inquiries = $inquirieRepository->findAll();

            return $this->render('inquirie/list.html.twig', [
                'inquiries' => $inquiries,
            ]);
        }
       $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/edit", name="inquirie_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Inquirie $inquirie
     * @return Response
     */
    public function edit(Request $request, Inquirie $inquirie): Response
    {
        $form = $this->createForm(InquirieType::class, $inquirie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inquirie_index');
        }

        return $this->render('inquirie/edit.html.twig', [
            'inquirie' => $inquirie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inquirie_delete", methods={"DELETE"})
     * @param Request $request
     * @param Inquirie $inquirie
     * @return Response
     */
    public function delete(Request $request, Inquirie $inquirie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inquirie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inquirie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inquirie_index');
    }

    /**
     * @Route("/{id}/accept", name="accept_offer")
     * @param Request $request
     * @return RedirectResponse
     */
    public function acceptOffer(Request $request)
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            $inquirie_id = $request->get('id');
            $inquirie = $this->getDoctrine()->getRepository(Inquirie::class)->find($inquirie_id);

            $entityManager = $this->getDoctrine()->getManager();

            $vehicle_id = $inquirie->getVehicle();

            $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
            $vehicle->setStatus('Sold');
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $entityManager->remove($inquirie);
            $entityManager->flush();

            $this->addFlash('warning', "Vehicle is sold out.");
            return $this->redirectToRoute('inquirie_list');
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/decline", name="decline_offer")
     * @param Request $request
     * @return RedirectResponse
     */
    public function declineOffer(Request $request)
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            $inquirie_id = $request->get('id');
            $inquirie = $this->getDoctrine()->getRepository(Inquirie::class)->find($inquirie_id);

            $entityManager = $this->getDoctrine()->getManager();

            $vehicle_id = $inquirie->getVehicle();

            $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
            $vehicle->setStatus('In stock');
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $entityManager->remove($inquirie);
            $entityManager->flush();

            $this->addFlash('warning', "Vehicle is again available in stock.");
            return $this->redirectToRoute('inquirie_list');
        }

        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }
}

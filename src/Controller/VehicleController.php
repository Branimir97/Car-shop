<?php

namespace App\Controller;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vehicle")
 */
class VehicleController extends AbstractController
{
    /**
     * @Route("/", name="vehicle_index", methods={"GET"})
     * @param VehicleRepository $vehicleRepository
     * @return Response
     */
    public function index(VehicleRepository $vehicleRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('vehicle/index.html.twig', [
                'vehicles' => $vehicleRepository->findAll(),
            ]);
        }
        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/new", name="vehicle_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
            $vehicle = new Vehicle();
            $form = $this->createForm(VehicleType::class, $vehicle);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $vehicle->setUser($this->getUser());
                $vehicle->setVisibility(1);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($vehicle);
                $entityManager->flush();

                return $this->redirectToRoute('vehicle_index');
            }

            return $this->render('vehicle/new.html.twig', [
                'vehicle' => $vehicle,
                'form' => $form->createView(),
            ]);
        }
        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}", name="vehicle_show", methods={"GET"})
     * @param Vehicle $vehicle
     * @return Response
     */
    public function show(Vehicle $vehicle): Response
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            return $this->render('vehicle/show.html.twig', [
                'vehicle' => $vehicle,
            ]);
        }
        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/edit", name="vehicle_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Vehicle $vehicle
     * @return Response
     */
    public function edit(Request $request, Vehicle $vehicle): Response
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            $form = $this->createForm(VehicleType::class, $vehicle);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('vehicle_index');
            }

            return $this->render('vehicle/edit.html.twig', [
                'vehicle' => $vehicle,
                'form' => $form->createView(),
            ]);
        }
        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}", name="vehicle_delete", methods={"DELETE"})
     * @param Request $request
     * @param Vehicle $vehicle
     * @return Response
     */
    public function delete(Request $request, Vehicle $vehicle): Response
    {
        if($this->isGranted('ROLE_ADMIN'))
        {
            if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($vehicle);
                $entityManager->flush();
            }
            return $this->redirectToRoute('vehicle_index');
        }
        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/visibility", name="vehicle_change_visibility")
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function changeVisibility(Vehicle $vehicle)
    {

        if($this->isGranted('ROLE_ADMIN'))
        {
            $entityManager = $this->getDoctrine()->getManager();
            if($vehicle->getVisibility())
            {
                $vehicle->setVisibility(0);
            } else
            {
                $vehicle->setVisibility(1);
            }
            $entityManager->persist($vehicle);
            $entityManager->flush();

            return $this->redirectToRoute('vehicle_index');
        }
        $this->addFlash('warning', "Permission denied.");
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/upload", name="upload_test")
     */
    public function temporaryUploadAction(Request $request)
    {

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('image');

        $destination = $this->getParameter('kernel.project_dir').'/public/uploads';

        $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFileName = $originalFileName .'-'. uniqid() .'.'.$uploadedFile->guessExtension();

        dd($uploadedFile->move($destination, $newFileName));
    }
}

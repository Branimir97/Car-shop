<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Vehicle;
use App\Form\VehicleType;
use App\Repository\VehicleRepository;
use App\Service\APIService;
use App\Service\UploaderHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vehicle")
 * @IsGranted("ROLE_ADMIN")
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
        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $vehicleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vehicle_new", methods={"GET","POST"})
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return Response
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class, $vehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vehicle);
            $entityManager->flush();

            /** @var UploadedFile $uploadedFile */
            $uploadedFiles = $form->get('imageFile')->getData();
            foreach ($uploadedFiles as $uploadedFile)
            {
                $newFileName = $uploaderHelper->uploadVehicleImage($uploadedFile);
                $image = new Image();
                $image->setImagePath($newFileName);
                $image->setVehicle($vehicle);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($image);
                $entityManager->flush();
            }
            return $this->redirectToRoute('vehicle_index');
        }
        return $this->render('vehicle/new.html.twig', [
            'vehicle' => $vehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vehicle_show", methods={"GET"})
     * @param Vehicle $vehicle
     * @return Response
     */
    public function show(Vehicle $vehicle): Response
    {
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vehicle_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Vehicle $vehicle
     * @return Response
     */
    public function edit(Request $request, Vehicle $vehicle): Response
    {
        $form = $this->createForm(VehicleType::class, $vehicle, ['required'=>false]);
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

    /**
     * @Route("/{id}", name="vehicle_delete", methods={"DELETE"})
     * @param Request $request
     * @param Vehicle $vehicle
     * @return Response
     */
    public function delete(Request $request, Vehicle $vehicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vehicle);
            $entityManager->flush();
        }
        return $this->redirectToRoute('vehicle_index');
    }

    /**
     * @Route("/{id}/visibility", name="vehicle_change_visibility")
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function changeVisibility(Vehicle $vehicle)
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
}

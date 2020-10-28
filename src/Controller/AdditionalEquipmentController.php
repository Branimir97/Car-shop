<?php

namespace App\Controller;

use App\Entity\AdditionalEquipment;
use App\Entity\Vehicle;
use App\Form\AdditionalEquipmentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdditionalEquipmentController extends AbstractController
{
    /**
     * @Route("/additional/equipment/add/{id}", name="additional_equipment_add", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $additional_equipment = new AdditionalEquipment();
        $vehicle_id = $request->get('id');
        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
        $vehicle_title = $vehicle->getMark().' '.$vehicle->getModel();
        $form = $this->createForm(AdditionalEquipmentFormType::class, $additional_equipment);
        $form->handleRequest($request);

        if($this->getUser() && $form->isSubmitted() && $form->isValid())
        {
            $additional_equipment->setVehicle($vehicle);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($additional_equipment);
            $entityManager->flush();

            $this->addFlash('success', 'Additional equipment successfully saved.');
            return $this->redirectToRoute('vehicle_index');
        }

        return $this->render('additional_equipment/index.html.twig', [
            'form' => $form->createView(),
            'vehicle_title' => $vehicle_title
        ]);
    }
}

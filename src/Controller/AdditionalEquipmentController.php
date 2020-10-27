<?php

namespace App\Controller;

use App\Entity\AdditionalEquipment;
use App\Entity\Vehicle;
use App\Form\AdditionalEquipmentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdditionalEquipmentController extends AbstractController
{
    /**
     * @Route("/additional/equipment/add/{id}", name="additional_equipment_add", methods={"GET", "POST"})
     */
    public function index(Request $request)
    {
        $additional_equipment = new AdditionalEquipment();
        $vehicle_id = $request->get('id');
        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
        $form = $this->createForm(AdditionalEquipmentFormType::class, $additional_equipment);
        $form->handleRequest($request);

        if($this->getUser() && $form->isSubmitted() && $form->isValid())
        {
            $additional_equipment->setVehicle($vehicle);
            //dd($form->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($additional_equipment);
            $entityManager->flush();
        }

        return $this->render('additional_equipment/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

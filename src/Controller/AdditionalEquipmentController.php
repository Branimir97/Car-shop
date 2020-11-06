<?php

namespace App\Controller;

use App\Entity\AdditionalEquipment;
use App\Entity\Vehicle;
use App\Form\AdditionalEquipmentFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**@IsGranted("ROLE_ADMIN") */

class AdditionalEquipmentController extends AbstractController
{
    /**
     * @Route("/additional/equipment/add/{id}", name="additional_equipment_add", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $vehicle_id = $request->get('id');
        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
        $vehicle_title = $vehicle->getMark().' '.$vehicle->getModel();

        $savedEquipment = $this->getDoctrine()->getRepository(AdditionalEquipment::class)->findOneBy(
            ['vehicle'=>$vehicle]
        );

        if($savedEquipment) {

            $form = $this->createForm(AdditionalEquipmentFormType::class, $savedEquipment);
            $form->handleRequest($request);

            if ($this->getUser() && $form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($savedEquipment);
                $entityManager->flush();

                $this->addFlash('success', 'Additional equipment successfully edited.');
            }
            return $this->render('additional_equipment/new.html.twig', [
                'form' => $form->createView(),
                'vehicle_title' => $vehicle_title
            ]);
        }
        $additionalEquipment = new AdditionalEquipment();
        $formNew = $this->createForm(AdditionalEquipmentFormType::class, $additionalEquipment);
        $formNew->handleRequest($request);

        if ($this->getUser() && $formNew->isSubmitted() && $formNew->isValid()) {
            $additionalEquipment->setVehicle($vehicle);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($additionalEquipment);
            $entityManager->flush();

            $this->addFlash('success', 'Additional equipment successfully saved.');
        }
        return $this->render('additional_equipment/new.html.twig', [
            'form' => $formNew->createView(),
            'vehicle_title' => $vehicle_title
        ]);
    }
}

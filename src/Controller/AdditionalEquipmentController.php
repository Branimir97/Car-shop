<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdditionalEquipmentController extends AbstractController
{
    /**
     * @Route("/additional/equipment/add/{id}", name="additional_equipment_add", methods={"GET"})
     */
    public function addEquipment()
    {
        return $this->render('additional_equipment/index.html.twig', [
            'controller_name' => 'AdditionalEquipmentController',
        ]);
    }
}

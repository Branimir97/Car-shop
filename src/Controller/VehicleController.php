<?php

namespace App\Controller;

use App\Form\AddVehicleFormType;
use App\Repository\VehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    /**
     * @Route("/", name="vehicle_list")
     * @param Request $request
     * @param VehicleRepository $vehicleRepository
     * @return Response
     */
    public function list(Request $request, VehicleRepository $vehicleRepository)
    {

        $vehicleForm = $this->createForm(AddVehicleFormType::class);
        $vehicleForm->handleRequest($request);


        $vehicles = $vehicleRepository->findAll();

        return $this->render('vehicle/list.html.twig', [
            'controller_name' => 'VehicleController',
            'vehicles' => $vehicles
        ]);
    }
}

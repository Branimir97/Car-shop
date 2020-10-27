<?php

namespace App\Controller;

use App\Entity\AdditionalEquipment;
use App\Entity\FavoriteVehicle;
use App\Entity\Vehicle;
use App\Form\InquirieFormType;
use App\Repository\ImageRepository;
use App\Repository\VehicleRepository;
use Doctrine\ORM\PersistentCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param VehicleRepository $vehicleRepository
     * @return Response
     */
    public function index(VehicleRepository $vehicleRepository)
    {
        $vehicles = $vehicleRepository->findAllAvailableAndVisible();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * @Route("vehicle/{id}/details", name="vehicle_details")
     * @param Request $request
     * @return Response
     */
    public function details(Request $request)
    {
        $vehicle_id = $request->get('id');
        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
        $favoriteVehicle = $this->getDoctrine()->getRepository(FavoriteVehicle::class)->findOneBy([
            'vehicle' => $vehicle,
            'user' => $this->getUser()
        ]);

        $additionalEquipment = $this->getDoctrine()->getRepository(AdditionalEquipment::class)->findOneBy([
            'vehicle' => $vehicle
        ]);
        //dd($additionalEquipment);
        return $this->render('home/details.html.twig', [
            'controller_name' => 'HomeController',
            'vehicle' => $vehicle,
            'favoriteVehicle' => $favoriteVehicle,
            'additionalEquipment' => $additionalEquipment
        ]);
    }

}

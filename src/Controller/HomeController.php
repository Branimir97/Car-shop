<?php

namespace App\Controller;

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
     * @param ImageRepository $imageRepository
     * @return Response
     */
    public function index(VehicleRepository $vehicleRepository, ImageRepository $imageRepository)
    {
        $vehicles = $vehicleRepository->findAll();
        //$images = $imageRepository->findAll();
        //dd($vehicles[0]->getImages());

        //dd($vehicles);
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'vehicles' => $vehicles,
        ]);
    }

    /**
     * @Route("vehicle/{id}/details", name="vehicle_details")
     * @param Request $request
     * @param ImageRepository $imageRepository
     * @return Response
     */
    public function details(Request $request, ImageRepository $imageRepository)
    {
        $vehicle_id = $request->get('id');
        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);

        $images = $imageRepository->findBy([
            'vehicle' => $vehicle
        ]);

        return $this->render('home/details.html.twig', [
            'controller_name' => 'HomeController',
            'vehicle' => $vehicle,
            'images' => $images
        ]);
    }

}

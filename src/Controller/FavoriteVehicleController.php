<?php

namespace App\Controller;

use App\Entity\FavoriteVehicle;
use App\Entity\Vehicle;
use App\Form\FavoriteVehicleType;
use App\Repository\FavoriteVehicleRepository;
use App\Repository\VehicleRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Json;

/**
 * @Route("/favorite/vehicle")
 * @IsGranted("ROLE_USER")
 */
class FavoriteVehicleController extends AbstractController
{
    /**
     * @Route("/", name="favorite_vehicle_index", methods={"GET"})
     * @param FavoriteVehicleRepository $favoriteVehicleRepository
     * @return Response
     */
    public function index(FavoriteVehicleRepository $favoriteVehicleRepository): Response
    {
        return $this->render('favorite_vehicle/index.html.twig', [
            'favorite_vehicles' => $favoriteVehicleRepository->findBy([
                'user' => $this->getUser()
            ]),
        ]);
    }

    /**
     * @Route("/new", name="favorite_vehicle_new", methods={"GET","POST"})
     * @param Request $request
     * @param VehicleRepository $vehicleRepository
     * @param FavoriteVehicleRepository $favoriteVehicleRepository
     * @return JsonResponse
     */


    public function new(Request $request, VehicleRepository $vehicleRepository, FavoriteVehicleRepository $favoriteVehicleRepository): JsonResponse
    {
        $vehicle_id = $request->request->get('vehicle');
        /**  @var Vehicle $vehicle */
        $vehicle = $vehicleRepository->find($vehicle_id);

        if ($vehicle) {
            $entityManager = $this->getDoctrine()->getManager();

            $favoriteVehicle = $favoriteVehicleRepository->findOneBy([
                'vehicle' => $vehicle,
                'user' => $this->getUser()
            ]);

            if ($favoriteVehicle) {
                $entityManager->remove($favoriteVehicle);
            } else {
                $favoriteVehicle = new FavoriteVehicle();
                $favoriteVehicle->setUser($this->getUser());
                $vehicle->addFavoriteVehicle($favoriteVehicle);
                $entityManager->persist($favoriteVehicle);
            }
            $entityManager->flush();
        }

        return new JsonResponse([
            'favorite' => isset($favoriteVehicle)
        ]);
    }

}

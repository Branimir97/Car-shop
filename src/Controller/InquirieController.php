<?php

namespace App\Controller;

use App\Entity\Inquirie;
use App\Entity\Vehicle;
use App\Form\InquirieType;
use App\Repository\InquirieRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inquirie")
 * @IsGranted("ROLE_ADMIN")
 */
class InquirieController extends AbstractController
{
    /**
     * @Route("/{id}/create", name="inquirie_create", methods={"GET", "POST"})
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     */
    public function create(Request $request, MailerInterface $mailer): Response
    {
        $inquirie = new Inquirie();
        $form = $this->createForm(InquirieType::class, $inquirie);
        $form->handleRequest($request);
        $vehicle_id = $request->get('id');
        /** @var Vehicle $vehicle */
        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
        $vehicle_title = $vehicle->getMark().' '.$vehicle->getModel();
        if($form->isSubmitted() && $form->isValid())
        {
            $inquirie->setUser($this->getUser());
            $inquirie->setVehicle($vehicle);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inquirie);
            $entityManager->flush();

            $vehicle->setStatus('Reserved');
            $entityManager->persist($vehicle);
            $entityManager->flush();

            try {
                $email = (new TemplatedEmail())
                    ->from($inquirie->getUser()->getEmail())
                    ->to('branimirb51@gmail.com')
                    ->subject("Inquirie for ".$vehicle_title)
                    ->htmlTemplate('emails/send_inquirie.html.twig')
                    ->context([
                        'username' => $inquirie->getUser()->getFirstName(),
                        'content' => $inquirie->getContent()
                    ]);

                $mailer->send($email);
            } catch (TransportExceptionInterface $transportException)
            {
                $this->addFlash('warning', 'Email can not be send, not available at the moment.');
            }

            $this->addFlash('success', 'Thanks for sending us offer for this vehicle. Owner is gonna answer you soon!');
            return $this->redirectToRoute('vehicle_details', ['id'=> $vehicle->getId()]);
        }
        return $this->render('inquirie/index.html.twig', [
            'form' => $form->createView(),
            'vehicle_title' => $vehicle_title
        ]);
    }

    /**
     * @Route("/", name="inquirie_list", methods={"GET"})
     * @param InquirieRepository $inquirieRepository
     * @return Response
     */
    public function show(InquirieRepository $inquirieRepository): Response
    {
        $inquiries = $inquirieRepository->findBy([], ['id'=>'DESC']);

        return $this->render('inquirie/list.html.twig', [
            'inquiries' => $inquiries,
        ]);
    }

    /**
     * @Route("/{id}/accept", name="accept_offer")
     * @param Request $request
     * @return RedirectResponse
     */
    public function acceptOffer(Request $request)
    {
        $inquirie_id = $request->get('id');
        $inquirie = $this->getDoctrine()->getRepository(Inquirie::class)->find($inquirie_id);

        $entityManager = $this->getDoctrine()->getManager();

        $vehicle_id = $inquirie->getVehicle();

        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
        $vehicle->setStatus('Sold');
        $entityManager->persist($vehicle);
        $entityManager->flush();

        $entityManager->remove($inquirie);
        $entityManager->flush();

        $this->addFlash('success', "Vehicle is sold out.");
        return $this->redirectToRoute('inquirie_list');
    }

    /**
     * @Route("/{id}/decline", name="decline_offer")
     * @param Request $request
     * @return RedirectResponse
     */
    public function declineOffer(Request $request)
    {
        $inquirie_id = $request->get('id');
        $inquirie = $this->getDoctrine()->getRepository(Inquirie::class)->find($inquirie_id);
        $entityManager = $this->getDoctrine()->getManager();
        $vehicle_id = $inquirie->getVehicle();
        $vehicle = $this->getDoctrine()->getRepository(Vehicle::class)->find($vehicle_id);
        $vehicle->setStatus('In stock');

        $entityManager->persist($vehicle);
        $entityManager->flush();
        $entityManager->remove($inquirie);
        $entityManager->flush();

        $this->addFlash('warning', "Vehicle is again available in stock.");
        return $this->redirectToRoute('inquirie_list');
    }
}

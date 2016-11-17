<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Reservationstatus;
use Datamart\MappingsBundle\Form\ReservationstatusType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReservationstatusController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $reservationstatusRepository = $em->getRepository('DatamartMappingsBundle:Reservationstatus');
        $reservationstatusMappingsList = $reservationstatusRepository->getReservationstatusWithHotel($page);

        $pages_count = ceil(count($reservationstatusMappingsList)/Reservationstatus::NB_RESERVATIONSTATUS_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_reservationstatus',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Reservationstatus:index.html.twig', array(
            'reservationstatusMappingsList' => $reservationstatusMappingsList,
            'pagination'                    => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $reservationstatus = new Reservationstatus();

        $form = $this->createForm(ReservationstatusType::class, $reservationstatus);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($reservationstatus);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Reservationstatus enregistré');

            return $this->redirectToRoute('datamart_mappings_reservationstatus');
        }

        return $this->render('KevinPortfolioBundle:Reservationstatus:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Reservationstatus $reservationstatus, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ReservationstatusType::class, $reservationstatus);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($reservationstatus);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Reservations Status modifié');

            return $this->redirectToRoute('datamart_mappings_reservationstatus');
        }

        return $this->render('DatamartMappingsBundle:Reservationstatus:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Reservationstatus $reservationstatus, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationstatus);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Reservationstatus supprimé !');
            return $this->redirectToRoute('datamart_mappings_reservationstatus');
        }

        return $this->render('DatamartMappingsBundle:Reservationstatus:delete.html.twig', [
            'reservationstatus'  => $reservationstatus,
            'form'     => $form->createView()
        ]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;

use Datamart\MappingsBundle\Entity\Roomtype;
use Datamart\MappingsBundle\Form\RoomtypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoomtypeController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $roomtypeRepository = $em->getRepository('DatamartMappingsBundle:Roomtype');
        $roomtypeMappingsList = $roomtypeRepository->getRoomtypesWithHotel($page);

        $pages_count = ceil(count($roomtypeMappingsList)/Roomtype::NB_ROOMTYPES_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_roomtype',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Roomtype:index.html.twig', array(
            'roomtypeMappingsList' => $roomtypeMappingsList,
            'pagination'           => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $roomtype = new Roomtype();

        $form = $this->createForm(RoomtypeType::class, $roomtype);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($roomtype);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Roomtype enregistré');

            return $this->redirectToRoute('datamart_mappings_roomtype');
        }

        return $this->render('DatamartMappingsBundle:Roomtype:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Roomtype $roomtype, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(RoomtypeType::class, $roomtype);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($roomtype);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Room Type modifié');

            return $this->redirectToRoute('datamart_mappings_roomtype');
        }

        return $this->render('DatamartMappingsBundle:Roomtype:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Roomtype $roomtype, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($roomtype);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Roomtype supprimé !');
            return $this->redirectToRoute('datamart_mappings_roomtype');
        }

        return $this->render('DatamartMappingsBundle:Roomtype:delete.html.twig', [
            'roomtype'  => $roomtype,
            'form'     => $form->createView()
        ]);
    }
}
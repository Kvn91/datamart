<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Travelagent;
use Datamart\MappingsBundle\Form\TravelagentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TravelagentController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $travelagentRepository = $em->getRepository('DatamartMappingsBundle:Travelagent');
        $travelagentMappingsList = $travelagentRepository->getTravelagents($page);

        $pages_count = ceil(count($travelagentMappingsList)/Travelagent::NB_TRAVELAGENTS_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_travelagent',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Travelagent:index.html.twig', array(
            'travelagentMappingsList' => $travelagentMappingsList,
            'pagination'              => $pagination,
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $travelagent = new Travelagent();

        $form = $this->createForm(TravelagentType::class, $travelagent);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($travelagent);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Travelagent enregistré');

            return $this->redirectToRoute('datamart_mappings_travelagent');
        }

        return $this->render('KevinPortfolioBundle:Travelagent:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Travelagent $travelagent, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(TravelagentType::class, $travelagent);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($travelagent);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Travel Agent modifié');

            return $this->redirectToRoute('datamart_mappings_travelagent');
        }

        return $this->render('DatamartMappingsBundle:Travelagent:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Travelagent $travelagent, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($travelagent);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Travelagent supprimé !');
            return $this->redirectToRoute('datamart_mappings_travelagent');
        }

        return $this->render('DatamartMappingsBundle:Travelagent:delete.html.twig', [
            'travelagent'  => $travelagent,
            'form'     => $form->createView()
        ]);
    }
}
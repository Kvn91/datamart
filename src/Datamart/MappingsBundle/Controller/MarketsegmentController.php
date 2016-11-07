<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Marketsegment;
use Datamart\MappingsBundle\Form\MarketsegmentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MarketsegmentController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $marketsegmentRepository = $em->getRepository('DatamartMappingsBundle:Marketsegment');
        $marketsegmentMappingsList = $marketsegmentRepository->getMarketsegments($page);

        $pages_count = ceil(count($marketsegmentMappingsList)/Marketsegment::NB_MARKETSEGMENTS_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_marketsegment',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Marketsegment:index.html.twig', array(
            'marketsegmentMappingsList' => $marketsegmentMappingsList,
            'pagination'                => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $marketsegment = new Marketsegment();

        $form = $this->createForm(MarketsegmentType::class, $marketsegment);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($marketsegment);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Marketsegment enregistré');

            return $this->redirectToRoute('datamart_mappings_marketsegment');
        }

        return $this->render('KevinPortfolioBundle:Marketsegment:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Marketsegment $marketsegment, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(Marketsegment::class, $marketsegment);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($marketsegment);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Market Segment modifié');

            return $this->redirectToRoute('datamart_mappings_marketsegment');
        }

        return $this->render('DatamartMappingsBundle:Marketsegment:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Marketsegment $marketsegment, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($marketsegment);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Marketsegment supprimé !');
            return $this->redirectToRoute('datamart_mappings_marketsegment');
        }

        return $this->render('DatamartMappingsBundle:Marketsegment:delete.html.twig', [
            'marketsegment'  => $marketsegment,
            'form'     => $form->createView()
        ]);
    }
}
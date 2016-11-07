<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Ratecategory;
use Datamart\MappingsBundle\Form\RatecategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RatecategoryController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $ratecategoryRepository = $em->getRepository('DatamartMappingsBundle:Ratecategory');
        $ratecategoryMappingsList = $ratecategoryRepository->getRatecategories($page);

        $pages_count = ceil(count($ratecategoryMappingsList)/Ratecategory::NB_RATECATEGORIES_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_ratecategory',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Ratecategory:index.html.twig', array(
            'ratecategoryMappingsList' => $ratecategoryMappingsList,
            'pagination'               => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ratecategory = new Ratecategory();

        $form = $this->createForm(RatecategoryType::class, $ratecategory);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($ratecategory);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Ratecategory enregistré');

            return $this->redirectToRoute('datamart_mappings_ratecategory');
        }

        return $this->render('KevinPortfolioBundle:Ratecategory:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Ratecategory $ratecategory, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(RatecategoryType::class, $ratecategory);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($ratecategory);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Rate Category modifié');

            return $this->redirectToRoute('datamart_mappings_ratecategory');
        }

        return $this->render('DatamartMappingsBundle:Ratecategory:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Ratecategory $ratecategory, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ratecategory);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Ratecategory supprimé !');
            return $this->redirectToRoute('datamart_mappings_ratecategory');
        }

        return $this->render('DatamartMappingsBundle:Ratecategory:delete.html.twig', [
            'ratecategory'  => $ratecategory,
            'form'     => $form->createView()
        ]);
    }
}
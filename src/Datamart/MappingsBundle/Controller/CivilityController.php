<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Civility;
use Datamart\MappingsBundle\Form\CivilityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CivilityController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $civilityRepository = $em->getRepository('DatamartMappingsBundle:Civility');
        $civilityMappingsList = $civilityRepository->getCivilities($page);

        $pages_count = ceil(count($civilityMappingsList)/Civility::NB_CIVILITIES_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_civility',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Civility:index.html.twig', array(
            'civilityMappingsList' => $civilityMappingsList,
            'pagination'           => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $civility = new Civility();

        $form = $this->createForm(CivilityType::class, $civility);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($civility);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Civility enregistré');

            return $this->redirectToRoute('datamart_mappings_civility');
        }

        return $this->render('KevinPortfolioBundle:Civility:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Civility $civility, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CivilityType::class, $civility);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($civility);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Civility modifié');

            return $this->redirectToRoute('datamart_mappings_civility');
        }

        return $this->render('DatamartMappingsBundle:Civility:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Civility $civility, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($civility);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Civility supprimé !');
            return $this->redirectToRoute('datamart_mappings_civility');
        }

        return $this->render('DatamartMappingsBundle:Civility:delete.html.twig', [
            'civility'  => $civility,
            'form'     => $form->createView()
        ]);
    }
}
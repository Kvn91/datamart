<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Ratecode;
use Datamart\MappingsBundle\Form\RatecodeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RatecodeController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $ratecodeRepository = $em->getRepository('DatamartMappingsBundle:Ratecode');
        $ratecodeMappingsList = $ratecodeRepository->getRatecodes($page);

        $pages_count = ceil(count($ratecodeMappingsList)/Ratecode::NB_RATECODES_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_ratecode',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Ratecode:index.html.twig', array(
            'ratecodeMappingsList' => $ratecodeMappingsList,
            'pagination'           => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $ratecode = new Ratecode();

        $form = $this->createForm(RatecodeType::class, $ratecode);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($ratecode);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Ratecode enregistré');

            return $this->redirectToRoute('datamart_mappings_ratecode');
        }

        return $this->render('KevinPortfolioBundle:Ratecode:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Ratecode $ratecode, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(RatecodeType::class, $ratecode);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($ratecode);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Rate Code modifié');

            return $this->redirectToRoute('datamart_mappings_ratecode');
        }

        return $this->render('DatamartMappingsBundle:Ratecode:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Ratecode $ratecode, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ratecode);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Ratecode supprimé !');
            return $this->redirectToRoute('datamart_mappings_ratecode');
        }

        return $this->render('DatamartMappingsBundle:Ratecode:delete.html.twig', [
            'ratecode'  => $ratecode,
            'form'     => $form->createView()
        ]);
    }
}
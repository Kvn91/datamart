<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Source;
use Datamart\MappingsBundle\Form\SourceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SourceController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $sourceRepository = $em->getRepository('DatamartMappingsBundle:Source');
        $sourceMappingsList = $sourceRepository->getSources($page);

        $pages_count = ceil(count($sourceMappingsList)/Source::NB_SOURCES_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_source',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Source:index.html.twig', array(
            'sourceMappingsList' => $sourceMappingsList,
            'pagination'         => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $source = new Source();

        $form = $this->createForm(SourceType::class, $source);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($source);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Source enregistré');

            return $this->redirectToRoute('datamart_mappings_source');
        }

        return $this->render('KevinPortfolioBundle:Source:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Source $source, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(SourceType::class, $source);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($source);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Source modifié');

            return $this->redirectToRoute('datamart_mappings_source');
        }

        return $this->render('DatamartMappingsBundle:Source:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Source $source, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($source);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Source supprimé !');
            return $this->redirectToRoute('datamart_mappings_source');
        }

        return $this->render('DatamartMappingsBundle:Source:delete.html.twig', [
            'source'  => $source,
            'form'     => $form->createView()
        ]);
    }
}
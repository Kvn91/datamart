<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Country;
use Datamart\MappingsBundle\Form\CountryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CountryController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $countryRepository = $em->getRepository('DatamartMappingsBundle:Country');
        $countryMappingsList = $countryRepository->getCountries($page);

        $pages_count = ceil(count($countryMappingsList)/Country::NB_COUNTRIES_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_country',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Country:index.html.twig', array(
            'countryMappingsList' => $countryMappingsList,
            'pagination'          => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $country = new Country();

        $form = $this->createForm(CountryType::class, $country);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($country);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Country enregistré');

            return $this->redirectToRoute('datamart_mappings_country');
        }

        return $this->render('KevinPortfolioBundle:Country:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Country $country, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(CountryType::class, $country);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($country);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Country modifié');

            return $this->redirectToRoute('datamart_mappings_country');
        }

        return $this->render('DatamartMappingsBundle:Country:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Country $country, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($country);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Country supprimé !');
            return $this->redirectToRoute('datamart_mappings_country');
        }

        return $this->render('DatamartMappingsBundle:Country:delete.html.twig', [
            'country'  => $country,
            'form'     => $form->createView()
        ]);
    }
}
<?php

namespace Datamart\CoreBundle\Controller;

use Datamart\CoreBundle\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
    public function homeAction()
    {
        return $this->render('DatamartCoreBundle:Core:home.html.twig');
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(SearchType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $expression = $request->request->get('search')['expression'];
            $em = $this->getDoctrine()->getManager();
            $civilityRepo = $em->getRepository('DatamartMappingsBundle:Civility');
            
            var_dump($expression);exit;
        }

        return $this->render('DatamartCoreBundle::search.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

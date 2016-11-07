<?php
/**
 * Created by PhpStorm.
 * User: Dev1
 * Date: 29/09/2016
 * Time: 11:26
 */

namespace Datamart\MappingsBundle\Controller;


use Datamart\MappingsBundle\Entity\Channel;
use Datamart\MappingsBundle\Form\ChannelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ChannelController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $em = $this->getDoctrine()->getManager();
        $channelRepository = $em->getRepository('DatamartMappingsBundle:Channel');
        $channelMappingsList = $channelRepository->getChannels($page);

        $pages_count = ceil(count($channelMappingsList)/Channel::NB_CHANNELS_PER_PAGE);

        if($page != 1 && $page > $pages_count){
            throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
        }

        $pagination = array(
            'page'         => $page,
            'pages_count'  => $pages_count,
            'route'        => 'datamart_mappings_channel',
            'route_params' => array()
        );

        return $this->render('DatamartMappingsBundle:Channel:index.html.twig', array(
            'channelMappingsList' => $channelMappingsList,
            'pagination'          => $pagination
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $channel = new Channel();

        $form = $this->createForm(ChannelType::class, $channel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            // Traitement du formulaire
            $em->persist($channel);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Channel enregistré');

            return $this->redirectToRoute('datamart_mappings_channel');
        }

        return $this->render('DatamartMappingsBundle:Channel:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function editAction(Channel $channel, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ChannelType::class, $channel);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            $em->persist($channel);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mapping Channel modifié');

            return $this->redirectToRoute('datamart_mappings_channel');
        }

        return $this->render('DatamartMappingsBundle:Channel:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction(Channel $channel, Request $request)
    {
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($channel);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Channel supprimé !');
            return $this->redirectToRoute('datamart_mappings_channel');
        }

        return $this->render('DatamartMappingsBundle:Channel:delete.html.twig', [
            'channel'  => $channel,
            'form'     => $form->createView()
        ]);
    }
}
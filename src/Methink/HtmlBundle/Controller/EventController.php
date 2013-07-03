<?php

namespace Methink\HtmlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Methink\HtmlBundle\Entity\Event;

class EventController extends Controller
{
    public function indexAction()
    {
    	$event = $this->getDoctrine()
    	        ->getRepository('MethinkHtmlBundle:Event')
    	        ->findAll();

    	return $this->render(
    		'MethinkHtmlBundle:Event:index.html.twig',
    		array('datas' => $event)
    	);
    }

    public function createAction()
    {
    	// create
    }
}

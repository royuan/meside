<?php

namespace Methink\HtmlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Methink\HtmlBundle\Entity\Event;
use \DateTime;

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
		$event = new Event();
		$event->setTitle('Write a blog post');
		$event->setStartAt(new DateTime('tomorrow'));

        $form = $this->createFormBuilder($event)
					 ->add('title', 'text')
					 ->add('start_at', 'date')
					 ->add('save', 'submit')
					 ->getForm();

        return $this->render('MethinkHtmlBundle:Event:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function createProcessAction()
    {
    	
    }
}

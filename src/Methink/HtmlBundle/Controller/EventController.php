<?php

namespace Methink\HtmlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Methink\HtmlBundle\Entity\Event;
use Methink\HtmlBundle\Form\Type\EventType;
use \DateTime;

class EventController extends Controller
{
    public function indexAction()
    {
    	$event = $this->getDoctrine()
                      ->getRepository('MethinkHtmlBundle:Event')
                      ->findAll();

    	return $this->render('MethinkHtmlBundle:Event:index.html.twig', array(
            'datas' => $event
        ));
    }

    public function createAction(Request $request)
    {
        // 创建 Event 实体
		$event = new Event();
		$event->setStartAt(new DateTime('today'));
        $event->setEndAt(new DateTime('tomorrow'));

        // 建造 Form
        $form = $this->createForm(new EventType(), $event);

        // 接受 Form 数据
        $form->handleRequest($request);

        // 验证
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return new Response('Yes');
        }

        // 渲染 Form 视图
        return $this->render('MethinkHtmlBundle:Event:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

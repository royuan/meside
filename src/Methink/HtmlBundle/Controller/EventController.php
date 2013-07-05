<?php

namespace Methink\HtmlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Methink\HtmlBundle\Entity\Event;
use Methink\HtmlBundle\Entity\User;
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

        // 建造 Form
        $form = $this->createForm(new EventType(), $event);

        // 接受 Form 数据
        $form->handleRequest($request);

        // 验证
        if ($form->isValid()) {

            // TODO: 替换成通过 AUTH Session 获得的用户信息
            // 临时方法，获得 User 对象，并设置用户对象
            $user = $this->getDoctrine()
                         ->getRepository('MethinkHtmlBundle:User')
                         ->find(1);

            // 写入 event 外键 user
            $event->setUser($user);

            // 写入数据库
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirect($this->generateUrl('methink_html_event_index'));
        }

        // 渲染 Form 视图
        return $this->render('MethinkHtmlBundle:Event:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}

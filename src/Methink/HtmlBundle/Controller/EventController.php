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
    /**
     * 列表页面控制器
     *
     * @return 视图
     */
    public function indexAction()
    {
    	$event = $this->getDoctrine()
                      ->getRepository('MethinkHtmlBundle:Event')
                      ->findAll();

    	return $this->render('MethinkHtmlBundle:Event:index.html.twig', array(
            'datas' => $event
        ));
    }

    /**
     * 创建控制器
     *
     * @param Symfony Request 实例
     *
     * @return handleForm处理后返回的视图数据
     */
    public function createAction(Request $request)
    {
        // TODO: 替换成通过 AUTH Session 获得的用户信息
        // 临时方法，获得 User 对象，并设置用户对象
        $user = $this->getDoctrine()
                     ->getRepository('MethinkHtmlBundle:User')
                     ->find(1);

		$event = new Event();
        $event->setStartAt(new DateTime('today'));
        $event->setEndAt(new DateTime('tomorrow'));
        $event->setUser($user);

        return $this->handleForm($event, $request);
    }

    /**
     * 编辑控制器
     *
     * @param int $event_id Event Entity ID
     *
     * @param Symfony Request 实例
     *
     * @return handleForm处理后返回的视图数据
     */
    public function editAction($event_id, Request $request)
    {
        $event = $this->getDoctrine()
                      ->getRepository('MethinkHtmlBundle:Event')
                      ->find($event_id);

        return $this->handleForm($event, $request);
    }

    /**
     * 创建 Form，验证 Form，存储 Form
     *
     * @param Entity Event 实例
     *
     * @param Symfony Request 实例
     *
     * @return 视图
     */
    protected function handleForm(Event $event, Request $request)
    {
        // 建造 Form
        $form = $this->createForm(new EventType(), $event);

        // 接受 Form 数据
        $form->handleRequest($request);

        // 验证
        if ($form->isValid()) {

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

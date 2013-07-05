<?php
namespace Methink\HtmlBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('title', 'text');
		$builder->add('content', 'textarea');
		$builder->add('address', 'text');
		$builder->add('organizer', 'text');
		$builder->add('start_at', 'date');
		$builder->add('end_at', 'date');
		$builder->add('hidden', 'choice', array(
			'choices' => array('1' => 'public', '0' => 'unpublic')
		));
		$builder->add('coverpath', 'text', array(
			'data' => 'nihao'
		));
		$builder->add('save', 'submit');
	}

	public function getName()
	{
		return 'event';
	}
}
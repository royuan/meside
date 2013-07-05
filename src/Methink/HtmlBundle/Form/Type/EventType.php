<?php
namespace Methink\HtmlBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use \DateTime;

class EventType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('title', 'text');
		$builder->add('content', 'textarea');
		$builder->add('address', 'text');
		$builder->add('organizer', 'text');
		$builder->add('start_at', 'datetime', array(
			'data' => new DateTime('today')
		));
		$builder->add('end_at', 'datetime', array(
			'data' => new DateTime('tomorrow')
		));
		$builder->add('save', 'submit');
	}

	public function getName()
	{
		return 'event';
	}
}
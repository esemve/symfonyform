<?php

declare(strict_types=1);

namespace AppBundle\Form\EventListener;

use AppBundle\Form\VisibilityChoiceType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class VisibilityEventListener implements EventSubscriberInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $options;

    public function __construct(string $name, string $type, array $options)
    {
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            //FormEvents::PRE_SUBMIT => 'preSubmit',
            // (MergeCollectionListener, MergeDoctrineCollectionListener)
            //FormEvents::SUBMIT => array('onSubmit', 50),
        );
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $data = $event->getData();

        // Remove ourself
        $parent = $form->getParent();
//        $parent->remove($this->name);

        // Replace with new structure
        $parent->add($this->name, FormType::class, ['data' => []]);
        $child = $parent->get($this->name);
        $options = array_merge($this->options, ['visibility_enabled' => false, 'data' => null]);
        $child->add('value', $this->type, $options);
        $child->add('visibility', VisibilityChoiceType::class);
    }
}
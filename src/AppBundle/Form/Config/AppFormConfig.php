<?php

namespace AppBundle\Form\Config;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Extension\Core\DataMapper\PropertyPathMapper;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\DataCollector\FormDataCollector;
use Symfony\Component\Form\Extension\DataCollector\FormDataExtractor;
use Symfony\Component\Form\Extension\DataCollector\Proxy\ResolvedTypeDataCollectorProxy;
use Symfony\Component\Form\FormConfigInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\Form\NativeRequestHandler;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\Form\ResolvedFormType;
use Symfony\Component\Form\ResolvedFormTypeFactory;
use Symfony\Component\Form\ResolvedFormTypeInterface;
use Symfony\Component\PropertyAccess\PropertyPathInterface;

class AppFormConfig implements FormConfigInterface
{
    protected $type;

    public function getEventDispatcher()
    {
        return new EventDispatcher();
    }

    public function getName()
    {
        return 'form';
    }

    public function getPropertyPath()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getMapped()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getByReference()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getInheritData()
    {
        return false;
    }

    public function getCompound()
    {
        return true;
    }

    public function getType()
    {
        $resistry = new FormRegistry([], new ResolvedFormTypeFactory());

        $proxy = $resistry->getType(FormType::class);

        return $proxy;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getViewTransformers()
    {
        return [];
    }

    public function getModelTransformers()
    {
        return [];
    }

    public function getDataMapper()
    {
        return new PropertyPathMapper();
    }

    public function getRequired()
    {
        return false;
    }

    public function getDisabled()
    {
        return false;
    }

    public function getErrorBubbling()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getEmptyData()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getAttributes()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function hasAttribute($name)
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getAttribute($name, $default = null)
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getData()
    {
        return null;
    }

    public function getDataClass()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getDataLocked()
    {
        return false;
    }

    public function getFormFactory()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getAction()
    {
        return $_SERVER['PHP_SELF'];
    }

    public function getMethod()
    {
        return 'POST';
    }

    public function getRequestHandler()
    {
        return new NativeRequestHandler();
    }

    public function getAutoInitialize()
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getOptions()
    {
        return [
            'block_name' => null,
            'translation_domain' => null,
            'label_format' => null,
            'label' => null,
            'label_attr' => null,
            'attr' => [],
        ];
    }

    public function hasOption($name)
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }

    public function getOption($name, $default = null)
    {
        throw new \BadMethodCallException('Method not implemented: '. __METHOD__);
    }
}
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
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\Form\FormConfigInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormRegistry;
use Symfony\Component\Form\NativeRequestHandler;
use Symfony\Component\Form\RequestHandlerInterface;
use Symfony\Component\Form\ResolvedFormType;
use Symfony\Component\Form\ResolvedFormTypeFactory;
use Symfony\Component\Form\ResolvedFormTypeInterface;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\PropertyAccess\PropertyPathInterface;

class AppFormConfig implements FormConfigInterface
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

    /**
     * AppFormConfig constructor.
     * @param string $name
     * @param string $type
     * @param array $options
     */
    public function __construct(string $name, string $type, array $options)
    {
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }

    private function isRoot()
    {
        return $this->name === 'form';
    }

    public function getEventDispatcher()
    {
        return new EventDispatcher();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getPropertyPath()
    {
        return $this->isRoot() ? null : new PropertyPath($this->getName());
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
        return $this->isRoot();
    }

    public function getType()
    {
        $resistry = new FormRegistry([], new ResolvedFormTypeFactory());

        $proxy = $resistry->getType($this->type);

        return $proxy;
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
        return $this->isRoot();
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function hasOption($name)
    {
        return array_key_exists($name, $this->options);
    }

    public function getOption($name, $default = null)
    {
        return array_key_exists($name, $this->options) ? $this->options[$name] : $default;
    }
}
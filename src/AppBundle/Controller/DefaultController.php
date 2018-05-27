<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use AppBundle\Entity\MyAddress;
use AppBundle\Form\Config\AppFormConfig;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\Helper\TranslatorHelper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $myAddress = $this->getDoctrine()->getRepository(MyAddress::class)->find(1);

        if (!$myAddress) {
            $myAddress = new MyAddress();
        }

        $form = $this->getAddressForm();

        $form->handleRequest();

        if ($form->isSubmitted())
        {
            $zip = $form->getData()['zip'];
            $city = $form->getData()['city'];
            $address = $form->getData()['address'];

            if (strlen(trim($zip))!=4) {
                $form->get('zip')->addError(new FormError('Az irányítószám nem 4 karakter hosszú!'));
            }

            if (!is_numeric(trim($zip))) {
                $form->get('zip')->addError(new FormError('Az irányítószám nem szám!'));
            }

            if (trim($city)==='') {
                $form->get('city')->addError(new FormError('A város megadása kötelező!'));
            }

            if (trim($address)==='') {
                $form->get('address')->addError(new FormError('A cím megadása kötelező!'));
            }

            if ($form->isValid()) {
                $myAddress->setZip($zip);
                $myAddress->setCity($city);
                $myAddress->setAddress($address);
                $myAddress->setUserId(1);
                $this->getDoctrine()->getManager()->persist($myAddress);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return $this->render('ugly/self.html.php', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/addresses", name="addresses")
     */
    public function addressesAction(Request $request)
    {
        // @todo: port back to master
        $addressBook = $this->getDoctrine()->getRepository(AddressBook::class)->find(1);

        if (!$addressBook) {
            $addressBook = new AddressBook();
        }

        $factory = $this->get('form.factory');
        $builder = $factory->createBuilder(FormType::class);

        $this->addContactForm($builder, $addressBook->getName(), $addressBook->getPhone());
        $this->addAddressForm($builder, $addressBook->getZip(), $addressBook->getCity(), $addressBook->getAddress());
        $this->addSubmitButton($builder);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $zip = $form->getData()['zip'];
            $city = $form->getData()['city'];
            $address = $form->getData()['address'];
            $name = $form->getData()['name'];
            $phone1 = $form->getData()['phone1'];
            $phone2 = $form->getData()['phone2'];

            if (strlen(trim($zip))!=4) {
                $form->get('zip')->addError(new FormError('Az irányítószám nem 4 karakter hosszú!'));
            }

            if (!is_numeric(trim($zip))) {
                $form->get('zip')->addError(new FormError('Az irányítószám nem szám!'));
            }

            if (trim($city)==='') {
                $form->get('city')->addError(new FormError('A város megadása kötelező!'));
            }

            if (trim($address)==='') {
                $form->get('address')->addError(new FormError('A cím megadása kötelező!'));
            }

            if (!in_array($phone1, ['3620','3630','3670'])) {
                $form->get('phone1')->addError(new FormError('A körzetszám nem megfelelő!'));
            }

            if (strlen(trim($phone2))!=7) {
                $form->get('phone2')->addError(new FormError('Nem megfelelő telefonszám!'));
            }

            if (!is_numeric($phone2)) {
                $form->get('phone2')->addError(new FormError('Nem megfelelő telefonszám!'));
            }

            if ($form->isValid()) {
                $addressBook->setZip($zip);
                $addressBook->setCity($city);
                $addressBook->setAddress($address);
                $addressBook->setPhone($phone1.'/'.$phone2);
                $addressBook->setName($name);
                $addressBook->setUserId(1);
                $this->getDoctrine()->getManager()->persist($addressBook);
                $this->getDoctrine()->getManager()->flush();
            }
        }

        return $this->render('ugly/addresses.html.php', [
            'form' => $form->createView(),
        ]);
    }


    protected function getAddressForm(): FormInterface
    {
        $form = new Form(new AppFormConfig());

        return $form;
    }

    protected function addAddressForm(FormBuilderInterface $builder, string $zip, string $city, string $address)
    {
        $builder->add('zip',TextType::class, [
            'label' => 'Irsz.',
            'data' => $zip,
            'translation_domain' => false,
        ]);

        $builder->add('city',TextType::class, [
            'label' => 'Város',
            'data' => $city,
            'translation_domain' => false,
        ]);

        $builder->add('address',TextType::class, [
            'label' => 'Utca, házszám',
            'data' => $address,
            'translation_domain' => false,
        ]);
    }

    protected function addContactForm(FormBuilderInterface $builder, string $name, string $phone)
    {
        list($phone1, $phone2) = strpos($phone, '/') ? explode('/', $phone) : [null, null];

        $builder->add('name',TextType::class, [
            'label' => 'Név.',
            'data' => $name,
            'translation_domain' => false,
        ]);

        $builder->add('phone1',ChoiceType::class, [
            'label' => 'Körzetszám',
            'data' => $phone1,
            'multiple' => false,
            'expanded' => false,
            'choices' => [
                '20' => '3620',
                '30' => '3630',
                '70' => '3670',
            ],
            'choice_translation_domain' => false,
            'translation_domain' => false,
        ]);

        $builder->add('phone2',TextType::class, [
            'label' => 'Telefonszám',
            'data' => $phone2,
            'translation_domain' => false,
        ]);
    }

    protected function addSubmitButton(FormBuilderInterface $builder)
    {
        $builder->add('submit', SubmitType::class, [
            'translation_domain' => false,
        ]);
    }
}



<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use AppBundle\Entity\MyAddress;
use AppBundle\Form\AddressFormType;
use AppBundle\Form\ContactFormType;
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

        $factory = $this->get('form.factory');
        $builder = $factory->createBuilder(AddressFormType::class, [
            'zip' => $myAddress->getZip(),
            'city' => $myAddress->getCity(),
            'address' => $myAddress->getAddress(),
        ]);

        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted())
        {
            $zip = $form->getData()['zip'];
            $city = $form->getData()['city'];
            $address = $form->getData()['address'];

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
        $addressBook = $this->getDoctrine()->getRepository(AddressBook::class)->find(1);

        if (!$addressBook) {
            $addressBook = new AddressBook();
        }

        list($phone1, $phone2) = !empty($addressBook->getPhone()) ? explode('/', $addressBook->getPhone(), 2) : [null, null];

        $factory = $this->get('form.factory');
        $builder = $factory->createBuilder(ContactFormType::class, [
            'zip' => $addressBook->getZip(),
            'city' => $addressBook->getCity(),
            'address' => $addressBook->getAddress(),
            'phone1' => $phone1,
            'phone2' => $phone2,
            'name' => $addressBook->getName(),
        ]);

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
}



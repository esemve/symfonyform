<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use AppBundle\Entity\MyAddress;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $errors = [];

        $myAddress = $this->getDoctrine()->getRepository(MyAddress::class)->find(1);

        if ($myAddress) {
            $zip = $myAddress->getZip();
            $city = $myAddress->getCity();
            $address = $myAddress->getAddress();
        } else {
            $myAddress = new MyAddress();
            $zip = '';
            $city = '';
            $address = '';
        }

        if ($request->isMethod('POST'))
        {

            if (/** @todo */true || $this->isCsrfTokenValid('sajat',$request->get('token'))) {
                $zip = $request->get('zip');
                $city = $request->get('city');
                $address = $request->get('address');

                if (strlen(trim($zip))!=4) {
                    $errors['zip'][] = 'Az irányítószám nem 4 karakter hosszú!';
                }

                if (!is_numeric(trim($zip))) {
                    $errors['zip'][] = 'Az irányítószám nem szám!';
                }

                if (trim($city)==='') {
                    $errors['city'][] = 'A város megadása kötelező!';
                }

                if (trim($address)==='') {
                    $errors['address'][] = 'A cím megadása kötelező!';
                }

                if (empty($errors)) {
                    $myAddress->setZip($zip);
                    $myAddress->setCity($city);
                    $myAddress->setAddress($address);
                    $myAddress->setUserId(1);
                    $this->getDoctrine()->getManager()->persist($myAddress);
                    $this->getDoctrine()->getManager()->flush();
                }
            } else {
                $errors['token'][] = 'CSRF token hiba!';
            }
        }

        return $this->render('ugly/self.html.php', [
            'zip' => $zip,
            'city' => $city,
            'address' => $address,
            'errors' => $errors
        ]);
    }

    /**
     * @Route("/addresses", name="addresses")
     */
    public function addressesAction(Request $request)
    {
        $errors = [];

        $addressBook = $this->getDoctrine()->getRepository(AddressBook::class)->find(1);

        if ($addressBook) {
            $zip = $addressBook->getZip();
            $city = $addressBook->getCity();
            $address = $addressBook->getAddress();
            $name = $addressBook->getName();
            $explodedPhone = explode('/', $addressBook->getPhone());
            $phone1 = $explodedPhone[0];
            $phone2 = $explodedPhone[1];

        } else {
            $addressBook = new AddressBook();
            $zip = '';
            $city = '';
            $name = '';
            $address = '';
            $phone1 = '';
            $phone2 = '';
        }

        if ($request->isMethod('POST'))
        {

            if (/** @todo */true || $this->isCsrfTokenValid('sajat',$request->get('token'))) {
                $zip = $request->get('zip');
                $city = $request->get('city');
                $address = $request->get('address');
                $name = $request->get('name');
                $phone1 = $request->get('phone1');
                $phone2 = $request->get('phone2');

                if (!in_array($phone1, ['3620','3630','3670'])) {
                    $errors['phone'][] = 'A körzetszám nem megfelelő!';
                }

                if (strlen(trim($phone2))!=7) {
                    $errors['phone'][] = 'Nem megfelelő telefonszám!';
                }

                if (!is_numeric($phone2)) {
                    $errors['phone'][] = 'Nem megfelelő telefonszám!';
                }

                if (strlen(trim($zip))!=4) {
                    $errors['zip'][] = 'Az irányítószám nem 4 karakter hosszú!';
                }

                if (!is_numeric(trim($zip))) {
                    $errors['zip'][] = 'Az irányítószám nem szám!';
                }

                if (trim($city)==='') {
                    $errors['city'][] = 'A város megadása kötelező!';
                }

                if (trim($address)==='') {
                    $errors['address'][] = 'A cím megadása kötelező!';
                }

                if (empty($errors)) {
                    $addressBook->setZip($zip);
                    $addressBook->setCity($city);
                    $addressBook->setAddress($address);
                    $addressBook->setPhone($phone1.'/'.$phone2);
                    $addressBook->setName($name);
                    $addressBook->setUserId(1);
                    $this->getDoctrine()->getManager()->persist($addressBook);
                    $this->getDoctrine()->getManager()->flush();
                }
            } else {
                $errors['token'][] = 'CSRF token hiba!';
            }
        }

        return $this->render('ugly/addresses.html.php', [
            'name' => $name,
            'phone1' => $phone1,
            'phone2' => $phone2,
            'zip' => $zip,
            'city' => $city,
            'address' => $address,
            'errors' => $errors
        ]);
    }
}



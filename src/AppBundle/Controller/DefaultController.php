<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AddressBook;
use AppBundle\Entity\EntityInterface;
use AppBundle\Entity\MyAddress;
use AppBundle\Form\AddressFormType;
use AppBundle\Form\ContactFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request): Response
    {
        $myAddress = $this->findEntity(MyAddress::class, 1) ?? new MyAddress();

        $form = $this->createForm(AddressFormType::class, $myAddress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistAndFlush($form->getNormData());
        }

        return $this->render('ugly/self.html.php', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/addresses", name="addresses")
     */
    public function addressesAction(Request $request): Response
    {
        $addressBook = $this->findEntity(AddressBook::class, 1) ?? new AddressBook();

        $form = $this->createForm(ContactFormType::class, $addressBook);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->persistAndFlush($form->getNormData());
        }

        return $this->render('ugly/addresses.html.php', [
            'form' => $form->createView(),
        ]);
    }

    public function persistAndFlush($entity): void
    {
        $this->getDoctrine()->getManager()->persist($entity);
        $this->getDoctrine()->getManager()->flush();
    }

    public function findEntity(string $type, int $id): ?EntityInterface
    {
        return $this->getDoctrine()->getRepository($type)->find($id);
    }
}



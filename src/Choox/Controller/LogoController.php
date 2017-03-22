<?php

namespace Choox\Controller;

use Choox\ChooxBundle;
use Choox\Entity\Logo;
use Choox\Form\LogoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 24.04.2016
 * Time: 19:37
 */
class LogoController extends Controller
{

    /**
     * @Route("/logo/create", name="createLogo")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $logo = new Logo();
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $logo->setUser($this->getUser()->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($logo);
            $em->flush();

            $this->addFlash(
                'success',
                'Your logo has been saved! Add another one!'
            );
            $this->redirectToRoute('createLogo', array(), 201);
        }

        return $this->render('logo/create.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * Sadly this does not work yet. Symfony says I have no doctrine.
     * Need to find out how to properly use xdebug here.
     * @param $originalName
     * @return array
     */
    public function findByOriginalLogoFileName($originalName)
    {
        $logoRepository = $this->getDoctrine()->getRepository('ChooxBundle:Logo');
        return $logoRepository->findBy(['original_logo' => $originalName]);
    }

    public function findByAlteredLogoFileName($alteredName)
    {
        $logoRepository = $this->getDoctrine()->getRepository('ChooxBundle:Logo');
        return $logoRepository->findBy(['alteredLogo' => $alteredName]);
    }

}
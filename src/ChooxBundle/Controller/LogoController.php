<?php

namespace ChooxBundle\Controller;

use ChooxBundle\Entity\Logo;
use ChooxBundle\Form\LogoType;
use Monolog\Logger;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoController extends Controller
{
    /**
     * @return Response
     * @Route(path="/logo", name="logo_list")
     */
    public function listAction()
    {
        /** @var Logo[] $logos */
        $logos = $this->getDoctrine()->getRepository('ChooxBundle:Logo')->findAll();

        return $this->render(':logo:list.html.twig', array('logos' => $logos));
    }

    public function adminListAction()
    {

    }

    /**
     * @param Request $request
     * @Route("/logo/create", name="createLogo")
     * @@Method({"GET", "POST"})
     * @return Response
     */
    public function createAction(Request $request)
    {
        $logo = new Logo();
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $logo->setUser($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($logo);
            $em->flush();

            unset($logo);
            unset($form);

            $this->addFlash(
                'success',
                $this->get('translator')->trans('logo.add.success')//'Your logo has been saved! Add another one!'
            );
            return $this->redirectToRoute('createLogo', array(), 201);
        } else {
            $this->get('logger')->log(Logger::WARNING, 'something obviously went wrong!');
        }

        return $this->render('logo/create.html.twig', [
            'form' => $form->createView(),
            'heading' => $this->get('translator')->trans('logo.create.heading')
        ]);
    }

    public function editAction()
    {

        }

    public function deleteAction()
    {

    }
}

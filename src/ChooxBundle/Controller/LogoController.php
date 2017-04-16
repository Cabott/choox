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

    /**
     * @return Response
     * @Route(path="/admin/logo", name="admin_logo_list")
     */
    public function adminListAction()
    {
        /** @var Logo[] $logos */
        $logos = $this->getDoctrine()->getRepository('ChooxBundle:Logo')->findBy([
            'approved' => 0
        ]);
        return $this->render(':logo:list.html.twig', array('logos' => $logos));
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

    /**
     * @Route("/logo/{id}/edit", name="editLogo")
     * @param Request $request
     * @param Logo $logo
     * @return Response
     */
    public function editAction(Request $request, Logo $logo)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(LogoType::class, $logo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($logo);
            $em->flush();

            $this->addFlash(
                'success',
                $this->get('translator')->trans('logo.edit.success')//'Your logo has been saved! Add another one!'
            );
            return $this->redirectToRoute('admin_logo_list', array(), 201);
        }

        return $this->render('logo/create.html.twig', [
            'form' => $form->createView(),
            'heading' => $this->get('translator')->trans('logo.edit.heading')
        ]);
    }

    /**
     * @param Logo $logo
     * @Route("/logo/{id}/delete", name="deleteLogo")
     * @return Response
     */
    public function deleteAction(Logo $logo)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($logo);
        $em->flush();
        $this->addFlash('success', $this->get('translator')->trans('logo.delete.success'));
        $this->redirectToRoute('admin_logo_list');
    }

    /**
     * @param Logo $logo
     * @Route("/logo/{id}/approve", name="approveLogo")
     * @return Response
     */
    public function approveAction(Logo $logo) {
        $logo->setApproved(true);
        $em = $this->getDoctrine()->getManager();
        $em->persist($logo);
        $em->flush();

        $this->addFlash(
            'success',
            $this->get('translator')->trans('logo.approve.success')
        );
        $this->redirectToRoute('admin_logo_list');
    }
}

<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    /**
    * @Route("/login/")
    */
    public function loginAction()
    {
      $html=$this->render('user/login.html.twig');
        return new Response($html);
    }

    /**
    * @Route("/register/")
    */
    public function registerAction()
    {
      $html=$this->render('user/register.html.twig');
        return new Response($html);
    }

}
?>

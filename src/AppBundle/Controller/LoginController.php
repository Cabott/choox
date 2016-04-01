<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LoginController extends Controller
{

    /**
     * @Route("/login/{user}")
     */
    public function loginAction($user)
    {
      $html=$this->render('login/index.html.twig',['user'=> $user]);
        return new Response($html);
    }
}
?>

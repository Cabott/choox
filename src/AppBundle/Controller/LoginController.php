<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return new Response('Hat geklappt');
    }
}
?>

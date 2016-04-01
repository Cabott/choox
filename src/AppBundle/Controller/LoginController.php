namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController {

  /**
   * @Route("/login")
   */
  public function login() {
    return new Response('Hat geklappt');
  }
}

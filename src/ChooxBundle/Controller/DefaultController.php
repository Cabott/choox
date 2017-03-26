<?php

namespace ChooxBundle\Controller;

use ChooxBundle\Service\TeamProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        /** @var TeamProvider $teamProvider */
        $teamProvider = $this->get('teamprovider');

        $seasons = $teamProvider->getSeasons();
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            'seasons' => $seasons
        ]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 09.04.2016
 * Time: 08:12
 */

namespace AppBundle\Service;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class TeamProvider
{
    protected $client;
    protected $header;

    public function __construct()
    {
        $this->setUp();
    }

    protected function setUp()
    {
        $this->client = new Client();
        $this->header = array('headers' => array('X-Auth-Token' => '91805d460c1f403dbf2c11cc6f649483'));
    }

    public function getSeasons()
    {
        $uri = 'http://api.football-data.org/v1/soccerseasons/';

        /** @var ResponseInterface $response */
        $response = $this->client->get($uri, $this->header);
        return json_decode($response->getBody());
    }
}
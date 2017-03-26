<?php
/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 09.04.2016
 * Time: 08:12
 */

namespace ChooxBundle\Service;

use Doctrine\Common\Cache\Cache;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class TeamProvider
{

    const CACHE_KEY_SEASONS_RAW      = 'ApiSeasonsRaw';
    const CACHE_KEY_SEASONS_CAPTIONS = 'ApiSeasonsCaptions';
    const CACHE_KEY_TEAM_NAMES       = 'ApiTeamNames';

    const API_URI_SOCCER_SEASONS = 'http://api.football-data.org/v1/soccerseasons/';

    /** @var  Client */
    protected $client;
    protected $header;
    /**
     * @var Cache
     */
    private $cache;

    /** @var integer seconds*/
    private $seasonsCacheLifeTime;
    /** @var integer seconds*/
    private $teamsCacheLifeTime;

    /**
     * TeamProvider constructor.
     * @param Cache $cache
     */
    public function __construct(Cache $cache)
    {
        $this->setUp();
        $this->cache = $cache;
    }

    protected function setUp()
    {
        $this->client = new Client();
        $this->header = array('headers' => array('X-Auth-Token' => '91805d460c1f403dbf2c11cc6f649483'));
        $this->setSeasonsCacheLifeTime(60*60*24*7); // cache seasons for one week
        $this->setTeamsCacheLifeTime(60*60*24); // cache teams for a day
    }

    /**
     * @return array
     */
    public function getSeasons()
    {
        if ($this->getCache()->contains(self::CACHE_KEY_SEASONS_RAW)) {
            return $this->getCache()->fetch(self::CACHE_KEY_SEASONS_RAW);
        }

        sleep(2);
        // nothing found in cache, query API

        /** @var ResponseInterface $response */
        $response = $this->client->get(self::API_URI_SOCCER_SEASONS, $this->header);
        $result   =  json_decode($response->getBody());
        $this->getCache()->save(self::CACHE_KEY_SEASONS_RAW, $result, $this->getSeasonsCacheLifeTime());

        return $result;
    }

    /**
     * @return string
     */
    public function getSeasonCaptions()
    {
        if ($this->getCache()->contains(self::CACHE_KEY_SEASONS_CAPTIONS)) {
            return $this->getCache()->fetch(self::CACHE_KEY_SEASONS_CAPTIONS);
        }

        $seasons  = $this->getSeasons();
        $captions = [];
        foreach ($seasons as $season) {
            $captions[] = $season->caption;
        }

        $result = json_encode($captions);
        $this->getCache()->save(self::CACHE_KEY_SEASONS_CAPTIONS, $result, $this->getSeasonsCacheLifeTime());

        return $result;
    }

    public function getTeamNames()
    {
        if ($this->getCache()->contains(self::CACHE_KEY_TEAM_NAMES)) {
            return $this->getCache()->fetch(self::CACHE_KEY_TEAM_NAMES);
        }

        $seasons = $this->getSeasons();
        $teamNames = [];
        foreach ($seasons as $season) {
            $uri      = self::API_URI_SOCCER_SEASONS.$season->id.'/teams';
            $response = $this->client->get($uri, $this->header);
            $teams    = json_decode($response->getBody());

            foreach ($teams->teams as $team) {
                if (!in_array($team->name, $teamNames)) {
                    $teamNames[] = $team->name;
                }
            }
        }

        $result = json_encode($teamNames);
        $this->getCache()->save(self::CACHE_KEY_TEAM_NAMES, $result, $this->getTeamsCacheLifeTime());

        return $result;
    }

    /**
     * @return Cache
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * @param Cache $cache
     */
    public function setCache($cache)
    {
        $this->cache = $cache;
    }

    /**
     * @return int
     */
    public function getSeasonsCacheLifeTime()
    {
        return $this->seasonsCacheLifeTime;
    }

    /**
     * @param int $seasonsCacheLifeTime
     */
    public function setSeasonsCacheLifeTime($seasonsCacheLifeTime)
    {
        $this->seasonsCacheLifeTime = $seasonsCacheLifeTime;
    }

    /**
     * @return int
     */
    public function getTeamsCacheLifeTime()
    {
        return $this->teamsCacheLifeTime;
    }

    /**
     * @param int $teamsCacheLifeTime
     */
    public function setTeamsCacheLifeTime($teamsCacheLifeTime)
    {
        $this->teamsCacheLifeTime = $teamsCacheLifeTime;
    }
}
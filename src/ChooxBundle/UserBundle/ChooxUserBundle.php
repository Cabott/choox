<?php
/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 09.04.2016
 * Time: 15:46
 */
namespace ChooxBundle\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChooxUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
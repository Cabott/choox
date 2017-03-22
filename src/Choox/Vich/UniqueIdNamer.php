<?php

namespace Choox\Vich;

/**
 * Created by PhpStorm.
 * User: msoliman
 * Date: 25.09.2016
 * Time: 15:31
 */
class UniqueIdNamer implements \Vich\UploaderBundle\Naming\NamerInterface
{
    use \Vich\UploaderBundle\Naming\Polyfill\FileExtensionTrait;

    public function name($object, \Vich\UploaderBundle\Mapping\PropertyMapping $mapping)
    {
        $name = random_bytes(10);
        $logoController = new \Choox\Controller\LogoController();

        while (!empty($logoController->findByAlteredLogoFileName($name))
                || !empty($logoController->findByOriginalLogoFileName($name))) {
            $name = random_bytes(10);
        }

        $file = $mapping->getFile($object);

        if ($extension = $this->getExtension($file)) {
            $name = sprintf('%s.%s', $name, $extension);
        }

        return $name;
    }
}
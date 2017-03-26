<?php

namespace ChooxBundle\Service\Vich;

use ChooxBundle\Entity\LogoRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class UniqueIdNamer
 * @Route("/logo", service="vich_unique_id_namer")
 * @package ChooxBundle\Service\Vich
 */
class UniqueIdNamer implements \Vich\UploaderBundle\Naming\NamerInterface
{
    use \Vich\UploaderBundle\Naming\Polyfill\FileExtensionTrait;

    /** @var LogoRepository */
    protected $_logoRepository;

    /**
     * UniqueIdNamer constructor.
     * @param LogoRepository $logoRepository
     */
    public function __construct(LogoRepository $logoRepository)
    {
        $this->_logoRepository = $logoRepository;
    }

    /**
     * @param object $object
     * @param \Vich\UploaderBundle\Mapping\PropertyMapping $mapping
     * @return string
     */
    public function name($object, \Vich\UploaderBundle\Mapping\PropertyMapping $mapping)
    {
        $name = $this->_generateRandomName();

        while (!empty($this->_logoRepository->findByAlteredLogoFileName($name))
                || !empty($this->_logoRepository->findByOriginalLogoFileName($name))) {
            $name = $this->_generateRandomName();
        }

        $file = $mapping->getFile($object);

        if ($extension = $this->getExtension($file)) {
            $name = sprintf('%s.%s', $name, $extension);
        }

        return $name;
    }

    /**
     * @return string
     */
    protected function _generateRandomName()
    {
        return md5(random_bytes(mt_rand(1, 30)));
    }
}
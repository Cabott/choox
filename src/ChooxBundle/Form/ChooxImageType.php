<?php

namespace ChooxBundle\Form;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ChooxImageType extends VichImageType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['object'] = $form->getParent()->getData();
        $view->vars['show_download_link'] = $options['download_link'];

        if ($view->vars['object'] && $view->vars['show_download_link']) {
            $view->vars['download_uri'] = $this->storage->resolveUri($form->getParent()->getData(), $form->getName());
        }
    }
}
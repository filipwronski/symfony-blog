<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface {

    use ContainerAwareTrait;

    public function categoryMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root', array(
            'childrenAttributes' => array( 'class' => 'dropdown-menu')
            )
        );

        $em = $this->container->get('doctrine')->getManager();

        $categories = $em->getRepository('AppBundle:Category')->findAll();

        
        foreach($categories as $category)
        
        $menu->addChild($category->getName(), array(
            'uri' => '/category/'.$category->getSlug(),
        ));
        
        return $menu;
    }

}

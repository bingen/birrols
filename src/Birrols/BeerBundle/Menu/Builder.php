<?php
// src/Birrols/BeerBundle/Menu/Builder.php
namespace Birrols\BeerBundle\Menu;

use Knp\Menu\FactoryInterface;
//use Symfony\Component\DependencyInjection\ContainerAware;

class Builder //extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', $options);

        $menu->addChild('menu.home', array('route' => 'welcome'))
                ->setExtra('translation_domain', 'BirrolsBeerBundle');
        $menu->addChild('menu.beers', array('route' => 'beers'))
                ->setExtra('translation_domain', 'BirrolsBeerBundle');
        $menu->addChild('menu.breweries', array('route' => 'business'))
                ->setExtra('translation_domain', 'BirrolsBeerBundle');
        $helpSubmenu = $this->helpMenu($factory, array('route' => 'welcome'));
        $helpSubmenu->setName('menu.help');
        $menu->addChild($helpSubmenu);

        return $menu;
    }
    public function helpMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', $options);

        $menu->addChild('menu.about', array('route' => 'about'));
        $menu->addChild('menu.contact', array('route' => 'contact'));
        $menu->addChild('menu.legal', array('route' => 'legal'));

        return $menu;
    }
}
?>

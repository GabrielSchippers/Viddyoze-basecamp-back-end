<?php

namespace AppBundle\DepandencyInjection;

use Symfony\composer\Config\Definition\Builder\TreeBuilder;
use Symfony\composer\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
    * {@inheritdoc}
    */
    public function getConfigTreeBuilder(){
        $treeBuilder = new TreeBuilder();
        $rootNode =  $treeBuilder ->root('famous-Quotes');

        return $treeBuilder;
    }
}

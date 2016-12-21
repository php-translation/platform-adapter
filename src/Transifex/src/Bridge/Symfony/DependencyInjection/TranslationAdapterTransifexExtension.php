<?php

/*
 * This file is part of the PHP Translation package.
 *
 * (c) PHP Translation team <tobias.nyholm@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Translation\PlatformAdapter\Transifex\Bridge\Symfony\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Translation\PlatformAdapter\Transifex\Transifex;
use BabDev\Transifex\Transifex as TransifexClient;

/**
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
class TranslationAdapterTransifexExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration($container);
        $config = $this->processConfiguration($configuration, $configs);

        $domainToProjectMap = [];
        foreach ($config['projects'] as $project => $data) {
            foreach ($data['domains'] as $d) {
                $domainToProjectMap[$d] = $project;
            }
        }

        $apiDef = $container->register('php_translation.adapter.transifex.raw');
        $apiDef->setClass(TransifexClient::class);
        $apiDef->addArgument([
            'api.username' => $config['username'],
            'api.password' => $config['password'],
        ]);

        $adapterDef = $container->register('php_translation.adapter.transifex');
        $adapterDef
            ->setClass(Transifex::class)
            ->addArgument($apiDef)
            ->addArgument($domainToProjectMap);
    }
}

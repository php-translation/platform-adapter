<?php

/*
 * This file is part of the PHP Translation package.
 *
 * (c) PHP Translation team <tobias.nyholm@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Translation\PlatformAdapter\Transifex\Tests\Functional;

use Nyholm\BundleTest\BaseBundleTestCase;
use Translation\PlatformAdapter\Transifex\Bridge\Symfony\TranslationAdapterTransifexBundle;
use Translation\PlatformAdapter\Transifex\Transifex;

class BundleInitializationTest extends BaseBundleTestCase
{
    protected function getBundleClass()
    {
        return TranslationAdapterTransifexBundle::class;
    }

    protected function setUp()
    {
        $kernel = $this->createKernel();
        $kernel->addConfigFile(__DIR__.'/../Resources/config.yml');
        parent::setUp();
    }

    public function testRegisterBundle()
    {
        $this->bootKernel();
        $container = $this->getContainer();

        $this->assertTrue($container->has('php_translation.adapter.transifex'));
        $service = $container->get('php_translation.adapter.transifex');
        $this->assertInstanceOf(Transifex::class, $service);
    }
}

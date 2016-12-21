<?php

namespace Translation\PlatformAdapter\Loco\Tests\Functional;

use Nyholm\BundleTest\BaseBundleTestCase;
use Translation\PlatformAdapter\Loco\Bridge\Symfony\TranslationAdapterLocoBundle;
use Translation\PlatformAdapter\Loco\Loco;

class BundleInitializationTest extends BaseBundleTestCase
{
    protected function getBundleClass()
    {
        return TranslationAdapterLocoBundle::class;
    }

    public function testRegisterBundle()
    {
        $this->bootKernel();
        $container = $this->getContainer();

        $this->assertTrue($container->has('php_translation.adapter.loco'));
        $service = $container->get('php_translation.adapter.loco');
        $this->assertInstanceOf(Loco::class, $service);
    }
}

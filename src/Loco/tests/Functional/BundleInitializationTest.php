<?php

namespace Translation\PlatformAdapter\Loco\Tests\Functional;

use Happyr\Mq2phpBundle\Service\ConsumerWrapper;
use Happyr\Mq2phpBundle\Service\MessageSerializerDecorator;
use Translation\PlatformAdapter\Loco\Bridge\Symfony\TranslationAdapterLocoBundle;

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
        $this->assertTrue($container->has('happyr.mq2php.message_serializer'));
        $client = $container->get('happyr.mq2php.message_serializer');
        $this->assertInstanceOf(MessageSerializerDecorator::class, $client);

        $this->assertTrue($container->has('happyr.mq2php.consumer_wrapper'));
        $client = $container->get('happyr.mq2php.consumer_wrapper');
        $this->assertInstanceOf(ConsumerWrapper::class, $client);
    }
}

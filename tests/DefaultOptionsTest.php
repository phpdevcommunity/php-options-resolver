<?php

namespace Test\PhpDevCommunity\Resolver;

use PhpDevCommunity\Resolver\Option;
use PhpDevCommunity\Resolver\OptionsResolver;
use PhpDevCommunity\UniTester\TestCase;

class DefaultOptionsTest extends TestCase
{
    protected function setUp(): void
    {
        // TODO: Implement setUp() method.
    }

    protected function tearDown(): void
    {
        // TODO: Implement tearDown() method.
    }

    protected function execute(): void
    {
        $resolver = new OptionsResolver([
            Option::new('action'),
            Option::new('method')->setDefaultValue('POST'),
            Option::new('id')->setDefaultValue('form-01'),
        ]);

        $options = $resolver->resolve([
            'action' => 'https://www.devcoder.xyz',
            'id' => 'form-payment'
        ]);
        $this->assertStrictEquals($options, ['action' => 'https://www.devcoder.xyz', 'method' => 'POST', 'id' => 'form-payment']);
    }
}

<?php

namespace Test\PhpDevCommunity\Resolver;

use PhpDevCommunity\Resolver\Option;
use PhpDevCommunity\Resolver\OptionsResolver;
use PhpDevCommunity\UniTester\TestCase;

class RequiredOptionsTest extends TestCase
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
            Option::new( 'action' ),
            Option::new( 'method' )
        ]);

        $this->expectException(\InvalidArgumentException::class, function () use ($resolver) {
            $resolver->resolve(['method' => 'GET']);
        });
    }
}

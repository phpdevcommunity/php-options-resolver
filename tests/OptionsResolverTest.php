<?php

namespace Test\PhpDevCommunity\Resolver;

use PhpDevCommunity\Resolver\Option;
use PhpDevCommunity\Resolver\OptionsResolver;
use PhpDevCommunity\UniTester\TestCase;

class OptionsResolverTest extends TestCase
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
        $this->testResolveOptionsSuccessfully();
        $this->testMissingRequiredOptions();
        $this->testInvalidOptions();
    }
    public function testResolveOptionsSuccessfully()
    {
        $resolver = new OptionsResolver([
            Option::new('option1'),
            Option::new('option2')->setDefaultValue('default'),
        ]);

        $options = $resolver->resolve([
            'option1' => 'value1',
        ]);

        $this->assertStrictEquals($options, ['option1' => 'value1', 'option2' => 'default']);
    }

    public function testMissingRequiredOptions()
    {
        $resolver = new OptionsResolver([
            Option::new('requiredOption'),
        ]);

        $this->expectException(\InvalidArgumentException::class, function () use ($resolver) {
            $resolver->resolve([]);
        });
    }

    public function testInvalidOptions()
    {
        $resolver = new OptionsResolver([
            Option::new('validOption')->validator(static function ($value) {
                return $value > 0;
            }),
        ]);

        $this->expectException(\InvalidArgumentException::class, function () use ($resolver) {
            $resolver->resolve(['validOption' => 0]);
        });
    }

}

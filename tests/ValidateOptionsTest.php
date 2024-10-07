<?php

namespace Test\PhpDevCommunity\Resolver;

use PhpDevCommunity\Resolver\Option;
use PhpDevCommunity\Resolver\OptionsResolver;
use PhpDevCommunity\UniTester\TestCase;

class ValidateOptionsTest extends TestCase
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
        $this->testNotValid();
        $this->testValid();
    }

    public function testNotValid(): void
    {
        $resolver = new OptionsResolver([
            Option::new('action')->validator(static function ($value) {
                return filter_var($value, FILTER_VALIDATE_URL) !== false;
            }),
            Option::new('method')->setDefaultValue('POST'),
        ]);

        $this->expectException(\InvalidArgumentException::class , function () use ($resolver) {
            $resolver->resolve([
                'action' => null,
            ]);
        });
    }

    public function testValid(): void
    {
        $resolver = new OptionsResolver([
            Option::new('action')->validator(static function ($value) {
                return filter_var($value, FILTER_VALIDATE_URL) !== false;
            }),
            Option::new('method')->setDefaultValue('POST'),
        ]);

        $options = $resolver->resolve([
            'action' => 'https://www.devcoder.xyz',
        ]);
        $this->assertStrictEquals($options, ['action' => 'https://www.devcoder.xyz', 'method' => 'POST']);
    }

}

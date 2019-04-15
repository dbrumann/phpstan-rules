<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests;

use Brumann\PHPStan\Rules\ConstructorPreferInterface;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

final class ConstructorPreferInterfaceTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new ConstructorPreferInterface();
    }

    public function test_rule_on_fixtures()
    {
        $files = [
            __DIR__ . '/Fixtures/ExampleWithConcrete.php',
            __DIR__ . '/Fixtures/ExampleWithConcreteAndPrivateConstructor.php',
            __DIR__ . '/Fixtures/ExampleWithConcreteImplementation.php',
            __DIR__ . '/Fixtures/ExampleWithDateTime.php',
            __DIR__ . '/Fixtures/ExampleWithInterface.php',
            __DIR__ . '/Fixtures/ExampleWithInterfaceAndPrivateConstructor.php',
            __DIR__ . '/Fixtures/ExampleWithMultipleArguments.php',
            __DIR__ . '/Fixtures/ExampleWithParentImplementation.php',
            __DIR__ . '/Fixtures/ExampleWithScalars.php',
        ];

        $errors = [
            [
                'Constructor argument #0 "$my" is of type Brumann\PHPStan\Rules\Tests\Dummy\MyConcreteImplementation but should be one of: Brumann\PHPStan\Rules\Tests\Dummy\MyInterface',
                11,
            ],
            [
                'Constructor argument #0 "$my" is of type Brumann\PHPStan\Rules\Tests\Dummy\MyConcreteImplementation but should be one of: Brumann\PHPStan\Rules\Tests\Dummy\MyInterface',
                11,
            ],
            [
                'Constructor argument #0 "$dateTime" is of type DateTimeImmutable but should be one of: DateTimeInterface',
                11,
            ],
            [
                'Constructor argument #2 "$myConcreteImplementation" is of type Brumann\PHPStan\Rules\Tests\Dummy\MyParentImplementation but should be one of: Brumann\PHPStan\Rules\Tests\Dummy\MyInterface',
                13
            ],
            [
                'Constructor argument #0 "$my" is of type Brumann\PHPStan\Rules\Tests\Dummy\MyParentImplementation but should be one of: Brumann\PHPStan\Rules\Tests\Dummy\MyInterface',
                11,
            ],
        ];

        $this->analyse($files, $errors);
    }
}

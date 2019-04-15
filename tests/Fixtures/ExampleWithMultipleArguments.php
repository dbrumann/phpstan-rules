<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\MyConcrete;
use Brumann\PHPStan\Rules\Tests\Dummy\MyInterface;
use Brumann\PHPStan\Rules\Tests\Dummy\MyParentImplementation;

class ExampleWithMultipleArguments
{
    private $mys;

    public function __construct(MyConcrete $myConcrete, MyInterface $myInterface, MyParentImplementation $myConcreteImplementation)
    {
        $this->mys = [$myConcrete, $myInterface, $myConcreteImplementation];
    }
}

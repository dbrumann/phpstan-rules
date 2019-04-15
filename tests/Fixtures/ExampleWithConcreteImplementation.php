<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\MyConcreteImplementation;

class ExampleWithConcreteImplementation
{
    private $my;

    public function __construct(MyConcreteImplementation $my)
    {
        $this->my = $my;
    }
}

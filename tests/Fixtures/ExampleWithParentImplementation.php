<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\MyParentImplementation;

class ExampleWithParentImplementation
{
    private $my;

    public function __construct(MyParentImplementation $my)
    {
        $this->my = $my;
    }
}

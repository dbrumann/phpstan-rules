<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\MyInterface;

class ExampleWithInterface
{
    private $my;

    public function __construct(MyInterface $my)
    {
        $this->my = $my;
    }
}
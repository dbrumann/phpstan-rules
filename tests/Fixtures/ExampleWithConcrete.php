<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\MyConcrete;

class ExampleWithConcrete
{
    private $my;

    public function __construct(MyConcrete $my)
    {
        $this->my = $my;
    }
}

<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\Bar;

class UsesBar
{
    private $bar;

    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }
}

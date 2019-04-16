<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\FizBaz;

class UsesFizBaz
{
    private $fizBaz;

    public function __construct(FizBaz $fizBaz)
    {
        $this->fizBaz = $fizBaz;
    }
}

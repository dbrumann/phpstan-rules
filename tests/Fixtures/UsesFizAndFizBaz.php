<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\Fiz;
use Brumann\PHPStan\Rules\Tests\Dummy\FizBaz;

class UsesFizAndFizBaz
{
    private $fiz;
    private $fizBaz;

    public function __construct(Fiz $fiz, FizBaz $fizBaz)
    {
        $this->fiz = $fiz;
        $this->fizBaz = $fizBaz;
    }
}

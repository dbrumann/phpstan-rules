<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\Fiz;

class UsesFiz
{
    private $fiz;

    public function __construct(Fiz $fiz)
    {
        $this->fiz = $fiz;
    }
}

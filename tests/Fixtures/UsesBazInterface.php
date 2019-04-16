<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use Brumann\PHPStan\Rules\Tests\Dummy\BazInterfaface;

class UsesBazInterface
{
    private $baz;

    public function __construct(BazInterfaface $baz)
    {
        $this->baz = $baz;
    }
}

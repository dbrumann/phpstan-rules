<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

class UsesInternalTypes
{
    private $data;

    public function __construct(int $myInt, bool $myBool, string $myString, array $myArray)
    {
        $this->data = [$myInt, $myBool, $myString, $myArray];
    }
}

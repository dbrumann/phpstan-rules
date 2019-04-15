<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

class ExampleWithScalars
{
    private $myInt;
    private $myString;
    private $myBool;

    public function __construct(int $myInt, string $myString, bool $myBool)
    {
        $this->myInt = $myInt;
        $this->myString = $myString;
        $this->myBool = $myBool;
    }
}

<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests\Fixtures;

use DateTimeImmutable;

class UsesDateTimeImmutable
{
    private $dateTime;

    public function __construct(DateTimeImmutable $dateTime)
    {
        $this->dateTime = $dateTime;
    }
}

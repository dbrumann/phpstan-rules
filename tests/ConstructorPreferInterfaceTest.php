<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules\Tests;

use Brumann\PHPStan\Rules\ConstructorPreferInterface;
use Brumann\PHPStan\Rules\Tests\Dummy\BazInterfaface;
use Brumann\PHPStan\Rules\Tests\Dummy\Fiz;
use Brumann\PHPStan\Rules\Tests\Dummy\FizBaz;
use Brumann\PHPStan\Rules\Tests\Dummy\FizInterface;
use DateTimeInterface;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use function sprintf;

final class ConstructorPreferInterfaceTest extends RuleTestCase
{
    protected function getRule(): Rule
    {
        return new ConstructorPreferInterface([DateTimeInterface::class]);
    }

    public function test_it_succeeds_with_class_without_interface(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/UsesBar.php'], []);
    }

    public function test_it_succeeds_with_interface(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/UsesBazInterface.php'], []);
    }

    public function test_it_succeeds_with_internal_types(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/UsesInternalTypes.php'], []);
    }

    public function test_it_succeeds_with_concrete_implementation_of_excluded_interface(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/UsesDateTimeImmutable.php'], []);
    }

    public function test_it_raises_error_when_using_concrete_class_with_interface(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/UsesFiz.php'],
            [
                [
                    sprintf('Constructor argument #0 "$fiz" is of type %s but should be one of: %s', Fiz::class, FizInterface::class),
                    11
                ]
            ]
        );
    }

    public function test_it_raises_error_with_all_possible_interface_declarations(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/UsesFizBaz.php'],
            [
                [
                    sprintf('Constructor argument #0 "$fizBaz" is of type %s but should be one of: %s, %s', FizBaz::class, FizInterface::class, BazInterfaface::class),
                    11
                ]
            ]
        );
    }

    public function test_it_raises_multiple_errors_when_multiple_arguments_are_concrete_instances(): void
    {
        $this->analyse(
            [__DIR__ . '/Fixtures/UsesFizAndFizBaz.php'],
            [
                [
                    sprintf('Constructor argument #0 "$fiz" is of type %s but should be one of: %s', Fiz::class, FizInterface::class),
                    13
                ],
                [
                    sprintf('Constructor argument #1 "$fizBaz" is of type %s but should be one of: %s, %s', FizBaz::class, FizInterface::class, BazInterfaface::class),
                    13
                ]
            ]
        );
    }
}

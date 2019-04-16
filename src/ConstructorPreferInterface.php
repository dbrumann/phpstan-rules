<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MissingMethodFromReflectionException;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleError;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\ObjectType;
use ReflectionClass;
use function array_filter;
use function count;
use function implode;
use function in_array;
use function sprintf;

final class ConstructorPreferInterface implements Rule
{
    private $excludedInterfaces;

    /**
     * @param string[] $excludedInterfaces List of interfaces to ignore
     */
    public function __construct(array $excludedInterfaces)
    {
        $this->excludedInterfaces = $excludedInterfaces;
    }

    public function getNodeType(): string
    {
        return ClassMethod::class;
    }

    /**
     * @param ClassMethod $node
     * @return RuleError[]
     *
     * @throws ShouldNotHappenException
     * @throws MissingMethodFromReflectionException
     */
    public function processNode(Node $node, Scope $scope): array
    {
        $methodName = (string) $node->name;
        if ($methodName !== '__construct') {
            return [];
        }
        if (count($node->getParams()) === 0) {
            return [];
        }
        $class = $scope->getClassReflection();
        if ($class === null) {
            throw new ShouldNotHappenException();
        }
        $errors = [];
        $method = $class->getNativeMethod($methodName);
        $parametersAcceptor = ParametersAcceptorSelector::selectSingle($method->getVariants());

        /** @var ParameterReflection $parameter */
        foreach ($parametersAcceptor->getParameters() as $offset => $parameter) {
            $parameterType = $parameter->getType();
            if (!$parameterType instanceof ObjectType) {
                continue;
            }
            $parameterClass = new ReflectionClass($parameterType->getClassName());

            $availableInterfaces = array_filter(
                $parameterClass->getInterfaceNames(),
                function (string $interfaceName) {
                    return !in_array($interfaceName, $this->excludedInterfaces);
                }
            );

            if (!$parameterClass->isInterface() && !empty($availableInterfaces)) {
                $errors[] = RuleErrorBuilder::message(sprintf(
                    'Constructor argument #%d "$%s" is of type %s but should be one of: %s',
                    $offset,
                    $parameter->getName(),
                    $parameterType->getClassName(),
                    implode(', ', $availableInterfaces)
                ))->build();
            }
        }

        return $errors;
    }
}

<?php declare(strict_types = 1);

namespace Brumann\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Stmt\ClassMethod;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\ObjectType;
use ReflectionClass;
use function count;
use function implode;
use function sprintf;

final class ConstructorPreferInterface implements Rule
{
    public function getNodeType(): string
    {
        return ClassMethod::class;
    }

    /**
     * @param ClassMethod $node
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
            /** @var ObjectType $parameterType */
            $parameterType = $parameter->getType();
            if (!$parameterType instanceof ObjectType) {
                continue;
            }
            $parameterClass = new ReflectionClass($parameterType->getClassName());

            if (!$parameterClass->isInterface() && !empty($parameterClass->getInterfaces())) {
                $errors[] = RuleErrorBuilder::message(sprintf(
                    'Constructor argument #%d "$%s" is of type %s but should be one of: %s',
                    $offset,
                    $parameter->getName(),
                    $parameterType->getClassName(),
                    implode(', ', $parameterClass->getInterfaceNames())
                ))->build();
            }
        }

        return $errors;
    }
}

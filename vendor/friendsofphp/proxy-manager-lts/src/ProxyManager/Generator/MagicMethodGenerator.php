<?php

declare(strict_types=1);

namespace ProxyManager\Generator;

use Laminas\Code\Generator\ParameterGenerator;
use ReflectionClass;
use ReflectionNamedType;

use function strtolower;

/**
 * Method generator for magic methods
 */
class MagicMethodGenerator extends MethodGenerator
{
    /**
     * @param ParameterGenerator[]|array[]|string[] $parameters
     */
    public function __construct(ReflectionClass $originalClass, string $name, array $parameters = [])
    {
        parent::__construct(
            $name,
            $parameters,
            self::FLAG_PUBLIC
        );

        $this->setReturnsReference(strtolower($name) === '__get');

        if (! $originalClass->hasMethod($name)) {
            return;
        }

        $originalMethod = $originalClass->getMethod($name);
        $returnType     = $originalMethod->getReturnType();

        if ($returnType instanceof ReflectionNamedType) {
            $this->setReturnType(($returnType->allowsNull() ? '?' : '') . $returnType->getName());
        }

        $this->setReturnsReference($originalMethod->returnsReference());
    }
}

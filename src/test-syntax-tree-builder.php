<?php

use SilenceDis\MultiSourceMapper\ConfigInterpreter\Exception\ExpressionInstantiationFailedException;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandStringExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainValueExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\InterpreterContext;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\SyntaxTreeBuilder\SyntaxTreeBuilder;

$array = [
    '!' => 'from-source',
    'source' => 'translations',
    'query' => [
        'category' => '!parameters defaultCategory',
        'message' => 'Some Text and Parameter "{parameter1}" ({parameter2})',
        'params' => [
            'parameter1' => [
                '!' => 'from-source',
                'source' => 'api.json',
                'query' => 'some.raw.json.key',
            ],
            'parameter2' => '!source api.source some.new.api.key',
        ],
    ],
];

$context = new InterpreterContext();

$syntaxTreeBuilder = new SyntaxTreeBuilder();
$syntaxTreeBuilder->registerInstantiator(new CommandStringExpressionInstantiator());
$syntaxTreeBuilder->registerInstantiator(new CommandArrayExpressionInstantiator($syntaxTreeBuilder));
$syntaxTreeBuilder->registerInstantiator(new PlainArrayExpressionInstantiator($syntaxTreeBuilder));
$syntaxTreeBuilder->registerInstantiator(new PlainValueExpressionInstantiator());

try {
    $expression = $syntaxTreeBuilder->build($array);
} catch (ExpressionInstantiationFailedException $e) {
    echo PHP_EOL.PHP_EOL."Failed to instantiate an expression.";
    exit;
}

print_r($expression);
echo PHP_EOL;
echo '---------------------------------------------------';
echo PHP_EOL;

$expression->interpret($context);
$result = $context->lookup($expression);

print_r($result);
//print_r(json_encode($result, JSON_PRETTY_PRINT));

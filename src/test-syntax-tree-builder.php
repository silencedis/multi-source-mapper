<?php

use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\ArrayCommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\CommandResolver\StringCommandResolver;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CommandStringExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\CompositeExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainArrayExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\ExpressionInstantiator\PlainValueExpressionInstantiator;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\InterpreterContext\DefaultInterpreterContext;
use SilenceDis\MultiSourceMapper\Mapper\MappingFailed;
use SilenceDis\MultiSourceMapper\Mapper\ObjectMapper;

require __DIR__ . '/../vendor/autoload.php';

$mapConfig = [
    '!' => 'get-source-value',
    'source' => 'translations',
    'query' => [
        'category' => '!get-source-value app.params defaultCategory',
        'message' => 'Some Text and Parameter "{parameter1}" ({parameter2})',
        'params' => [
            'parameter1' => [
                '!' => 'get-source-value',
                'source' => 'api.json',
                'query' => 'some.raw.json.key',
            ],
            'parameter2' => '!get-source-value api.source some.new.api.key',
        ],
    ],
];

// ------------------

$compositeInstantiator = new CompositeExpressionInstantiator();

$compositeInstantiator->registerInstantiator(
    new CommandStringExpressionInstantiator(
        new StringCommandResolver()
    )
);
$compositeInstantiator->registerInstantiator(
    new CommandArrayExpressionInstantiator(
        new ArrayCommandResolver(),
        $compositeInstantiator
    )
);
$compositeInstantiator->registerInstantiator(
    new PlainArrayExpressionInstantiator(
        $compositeInstantiator
    )
);
$compositeInstantiator->registerInstantiator(
    new PlainValueExpressionInstantiator()
);

$mapper = new ObjectMapper($compositeInstantiator, new DefaultInterpreterContext());

try {
    $result = $mapper->map($mapConfig);
} catch (MappingFailed $e) {
    echo PHP_EOL . PHP_EOL . $e->getMessage() . PHP_EOL;
    exit;
}

echo PHP_EOL . PHP_EOL;
/** @noinspection PhpComposerExtensionStubsInspection */
print_r(json_encode($result, JSON_PRETTY_PRINT));
echo PHP_EOL;
<?php

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

$mapper = new ObjectMapper();

try {
    $result = $mapper->map($mapConfig);
} catch (MappingFailed $e) {
    echo PHP_EOL . PHP_EOL . $e->getMessage() . PHP_EOL;
    exit;
}

echo PHP_EOL . PHP_EOL;
print_r(json_encode($result, JSON_PRETTY_PRINT));
echo PHP_EOL;
<?php

use SilenceDis\MultiSourceMapper\Mapper\Exception\MapperException;
use SilenceDis\MultiSourceMapper\Mapper\ObjectMapper;

require __DIR__.'/../vendor/autoload.php';

$mapConfig = [
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

$mapper = new ObjectMapper($mapConfig);

try {
    $result = $mapper->map();
} catch (MapperException $e) {
    echo PHP_EOL.PHP_EOL.$e->getMessage().PHP_EOL;
    exit;
}

print_r(json_encode($result, JSON_PRETTY_PRINT));

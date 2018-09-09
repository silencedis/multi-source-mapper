<?php

namespace SilenceDis\MultiSourceMapper\ConfigInterpreter\Command;

/**
 * Class GetSourceValueCommand
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 */
final class GetSourceValueCommand implements Command
{
    /**
     * @var string
     */
    private $source;
    /**
     * @var mixed
     */
    private $query;
    
    /**
     * GetSourceValueCommand constructor.
     *
     * @param string $source Source name.
     * @param mixed $query Value query.
     */
    public function __construct(string $source, $query)
    {
        $this->source = $source;
        $this->query = $query;
    }
    
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $contents = [
            '>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>',
            self::class,
            '[SOURCE]: ' . $this->source,
            '-------------------------',
            '[QUERY]: ' . json_encode($this->query, JSON_PRETTY_PRINT),
            '<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<',
        ];
        
        echo PHP_EOL;
        echo implode(PHP_EOL, $contents);
        echo PHP_EOL;
        
        return "$this->source: " . uniqid();
    }
}

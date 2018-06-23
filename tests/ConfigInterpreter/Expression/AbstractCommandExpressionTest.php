<?php

namespace SilenceDis\MultiSourceMapper\Test\ConfigInterpreter\Expression;

use PHPUnit\Framework\TestCase;
use SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\AbstractCommandExpression;
use SilenceDis\MultiSourceMapper\MsmInterface\ConfigInterpreter\CommandResolver\CommandResolverInterface;
use SilenceDis\PHPUnitMockHelper\MockHelper;
use SilenceDis\ProtectedMembersAccessor\ProtectedMembersAccessor;

/**
 * Class AbstractCommandExpressionTest
 *
 * @author Yurii Slobodeniuk <silencedis@gmail.com>
 *
 * @coversDefaultClass \SilenceDis\MultiSourceMapper\ConfigInterpreter\Expression\AbstractCommandExpression
 */
class AbstractCommandExpressionTest extends TestCase
{
    /**
     * @var MockHelper
     */
    private $mockHelper;
    /**
     * @var ProtectedMembersAccessor
     */
    private $membersAccessor;
    
    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        $this->mockHelper = new MockHelper($this);
        $this->membersAccessor = new ProtectedMembersAccessor();
    }
    
    /**
     * @covers ::getCommandResolver
     *
     * @throws \SilenceDis\PHPUnitMockHelper\Exception\InvalidMockTypeException
     * @throws \SilenceDis\ProtectedMembersAccessor\Exception\ProtectedMembersAccessException
     */
    public function testGetCommandResolver()
    {
        $commandResolver = $this->mockHelper->mockObject(
            CommandResolverInterface::class,
            [
                'mockType' => MockHelper::MOCK_TYPE_ABSTRACT,
            ]
        );
        
        $testExpression = $this->mockHelper->mockObject(
            AbstractCommandExpression::class,
            [
                'mockType' => MockHelper::MOCK_TYPE_ABSTRACT,
            ]
        );
        
        $this->membersAccessor->setProtectedProperty(
            AbstractCommandExpression::class,
            $testExpression,
            'commandResolver',
            $commandResolver
        );
        
        $closure = $this->membersAccessor->getProtectedMethod(
            AbstractCommandExpression::class,
            $testExpression,
            'getCommandResolver'
        );
        
        $actualResult = $closure();
        
        $this->assertEquals(
            $commandResolver,
            $actualResult,
            "The method 'getCommandResolver()' must return the CommandResolverIntance that has been set through a constructor."
        );
    }
}

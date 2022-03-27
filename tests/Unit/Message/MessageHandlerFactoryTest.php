<?php

namespace Tests\Unit\Message;

use Exception;
use PHPUnit\Framework\TestCase;
use Recman\Message\LogHandlers\DebugHandler;
use Recman\Message\LogHandlers\ErrorHandler;
use Recman\Message\LogHandlers\FatalHandler;
use Recman\Message\LogHandlers\InfoHandler;
use Recman\Message\LogHandlers\TraceHandler;
use Recman\Message\LogHandlers\WarningHandler;
use Recman\Message\Message;
use Recman\Message\MessageHandlerFactory;
use Recman\Message\MessageInterface;

class MessageHandlerFactoryTest extends TestCase
{
    private MessageHandlerFactory $factory;

    public function setUp(): void
    {
        $this->factory = new MessageHandlerFactory(
            new DebugHandler(),
            new ErrorHandler(),
            new FatalHandler(),
            new InfoHandler(),
            new TraceHandler(),
            new WarningHandler()
        );
    }

    /**
     * @param string $type
     * @param string $class
     * @dataProvider dataProvider
     * @throws Exception
     *
     */
    public function testAllHandlersCreation(string $type, string $class): void
    {
        $message = new Message("test", "$type", "1", "3");
        $this->assertInstanceOf($class, $this->factory->creatHandler($message));
    }

    public function dataProvider(): array
    {
        return [
            ['debug', DebugHandler::class],
            ['error', ErrorHandler::class],
            ['fatal', FatalHandler::class],
            ['info', InfoHandler::class],
            ['trace', TraceHandler::class],
            ['warning', WarningHandler::class]
        ];
    }
}
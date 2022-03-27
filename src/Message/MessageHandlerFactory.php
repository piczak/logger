<?php

namespace Recman\Message;

use Exception;
use Recman\Message\Enum\MessageTypeEnum;
use Recman\Message\LogHandlers\DebugHandler;
use Recman\Message\LogHandlers\ErrorHandler;
use Recman\Message\LogHandlers\FatalHandler;
use Recman\Message\LogHandlers\InfoHandler;
use Recman\Message\LogHandlers\TraceHandler;
use Recman\Message\LogHandlers\WarningHandler;

class MessageHandlerFactory
{
    private DebugHandler $debugHandler;
    private ErrorHandler $errorHandler;
    private FatalHandler $fatalHandler;
    private InfoHandler $infoHandler;
    private TraceHandler $traceHandler;
    private WarningHandler $warningHandler;

    public function __construct(
        DebugHandler $debugHandler,
        ErrorHandler $errorHandler,
        FatalHandler $fatalHandler,
        InfoHandler $infoHandler,
        TraceHandler $traceHandler,
        WarningHandler $warningHandler
    )
    {
        $this->debugHandler = $debugHandler;
        $this->errorHandler = $errorHandler;
        $this->fatalHandler = $fatalHandler;
        $this->infoHandler = $infoHandler;
        $this->traceHandler = $traceHandler;
        $this->warningHandler = $warningHandler;
    }

    /**
     * @throws Exception
     */
    public function creatHandler(Message $message): MessageInterface
    {
        $type = $message->getType();

        switch($type) {
            case MessageTypeEnum::DEBUG:
                return $this->debugHandler->process($message);
            case MessageTypeEnum::ERROR:
                return $this->errorHandler->process($message);
            case MessageTypeEnum::FATAL:
                return $this->fatalHandler->process($message);
            case MessageTypeEnum::INFO:
                return $this->infoHandler->process($message);
            case MessageTypeEnum::TRACE:
                return $this->traceHandler->process($message);
            case MessageTypeEnum::WARNING:
                return $this->warningHandler->process($message);
            default:
                throw new Exception(
                    $type . ' is not supported log type!'
                );
        }
    }
}
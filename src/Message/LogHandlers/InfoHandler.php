<?php

namespace Recman\Message\LogHandlers;

use Recman\Message\Message;
use Recman\Message\MessageInterface;

class InfoHandler implements MessageInterface
{
    private const UNIQUE_VALUE = 40;

    private int $uniqueValue;

    private Message $message;

    public function process(Message $message): InfoHandler
    {
        $this->setMessage($message);
        $this->setCalculatedUniqueValue();
        return $this;
    }

    public function getCalculatedUniqueValue(): int
    {
        return $this->uniqueValue;
    }

    public function getMessage(): Message
    {
        return $this->message;
    }

    private function setMessage(Message $message): void
    {
        $this->message = $message;
    }

    private function setCalculatedUniqueValue(): void
    {
        $this->uniqueValue = $this->message->getReceiver() + $this->message->getPriority() + self::UNIQUE_VALUE;
    }
}

<?php

namespace Recman\Message;

interface MessageInterface
{
    public function process(Message $message): MessageInterface;
    public function getMessage(): Message;
    public function getCalculatedUniqueValue(): int;
}

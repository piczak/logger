<?php

namespace Recman\Service;

use Recman\Mapper\PriorityMapper;
use Recman\Mapper\ReceiverMapper;
use Recman\Message\Message;

class MessageService
{
    private PriorityMapper $priorityMapper;
    private ReceiverMapper $receiverMapper;

    public function __construct(
        PriorityMapper $priorityMapper,
        ReceiverMapper $receiverMapper
    )
    {
        $this->priorityMapper = $priorityMapper;
        $this->receiverMapper = $receiverMapper;
    }

    public function parseMessage(string $json): ?Message
    {
        $rawObject = json_decode($json);
        return new Message(
            (string)$rawObject->body,
            (string)$rawObject->type,
            $this->getReceiver((string)$rawObject->receiver),
            $this->getPriority((string)$rawObject->priority),
        );
    }

    private function getReceiver(string $receiver): int
    {
        return $this->receiverMapper->map($receiver);
    }

    private function getPriority(string $priority): int
    {
        return $this->priorityMapper->map($priority);
    }
}
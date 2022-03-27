<?php

namespace Recman\Message;

class Message
{
    private string $body;
    private string $type;
    private int $receiver;
    private int $priority;

    public function __construct (
        string $body,
        string $type,
        int $receiver,
        int $priority
    )
    {
        $this->body = $body;
        $this->type = $type;
        $this->receiver =$receiver;
        $this->priority = $priority;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getReceiver(): int
    {
        return $this->receiver;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }
}

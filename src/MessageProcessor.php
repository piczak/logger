<?php

namespace Recman;

use Exception;
use Recman\Message\MessageFlow;
use Recman\Service\MessageService;

class MessageProcessor
{
    private MessageFlow $flow;
    private MessageService $service;

    public function __construct(
        MessageFlow $flow,
        MessageService $service
    )
    {
        $this->flow = $flow;
        $this->service = $service;
    }

    /**
     * @throws Exception
     */
    public function process(string $json): void
    {
        $this->flow->process($this->service->parseMessage($json));
    }
}

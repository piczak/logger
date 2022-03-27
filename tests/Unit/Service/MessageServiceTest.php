<?php

namespace Tests\Unit\Service;

use PHPUnit\Framework\TestCase;
use Recman\Mapper\PriorityMapper;
use Recman\Mapper\ReceiverMapper;
use Recman\Message\Message;
use Recman\Service\MessageService;

class MessageServiceTest extends TestCase
{
    public function testIfParseMessageReturnMessage(): void
    {
        $priorityMapper = $this->createMock(PriorityMapper::class);
        $priorityMapper
            ->expects(self::once())
            ->method('map')
            ->with('high')
            ->willReturn(3);

        $receiverMapper = $this->createMock(ReceiverMapper::class);
        $receiverMapper
            ->expects(self::once())
            ->method('map')
            ->with('user')
            ->willReturn(1);

        $json = '{"body": "test","type": "info","receiver": "user","priority": "high" }';

        $messageService = new MessageService($priorityMapper, $receiverMapper);

        $message = new Message("test", "info", "1", "3");
        $this->assertEquals($message, $messageService->parseMessage($json));
    }
}

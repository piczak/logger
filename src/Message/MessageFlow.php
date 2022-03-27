<?php

namespace Recman\Message;

use Exception;
use Recman\db\DatabasePusher;

class MessageFlow
{
    private MessageHandlerFactory $factory;
    private DatabasePusher $databasePusher;

    public function __construct(
        MessageHandlerFactory $factory,
        DatabasePusher $databasePusher
    )
    {
        $this->factory = $factory;
        $this->databasePusher = $databasePusher;
    }

    /** @throws Exception */
    public function process(Message $message): void
    {
        $handler = $this->factory->creatHandler($message);
        $this->databasePusher->storeInDatabase($handler);
    }
}

<?php

declare(strict_types = 1);

use Dotenv\Dotenv;
use Recman\db\Connection;
use Recman\db\DatabasePusher;
use Recman\Mapper\PriorityMapper;
use Recman\Mapper\ReceiverMapper;
use Recman\Message\MessageFlow;
use Recman\MessageProcessor;
use Recman\Service\MessageService;
use function DI\autowire;
use function DI\get;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

return [
    'Connection' => autowire(Connection::class)
        ->constructor(new PDO(
            $_ENV['DB_DSN'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS']
        )),
    DatabasePusher::class => autowire(DatabasePusher::class)
        ->constructor(
            get('Connection')
        ),
    MessageProcessor::class => autowire(MessageProcessor::class)
        ->constructor(
            get(MessageFlow::class),
            get(MessageService::class),
        ),
    PriorityMapper::class => autowire(PriorityMapper::class)
        ->constructor([
            'high' => 3,
            'medium' => 2,
            'low' => 1
        ]),
    ReceiverMapper::class => autowire(ReceiverMapper::class)
        ->constructor([
            'superuser' => 3,
            'admin' => 2,
            'user' => 1
        ]),
];

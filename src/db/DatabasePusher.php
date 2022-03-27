<?php

namespace Recman\db;

use PDO;
use PDOException;
use Recman\Message\MessageInterface;

class DatabasePusher
{
    private Connection $pdo;

    public function __construct(Connection $pdo)
    {
        $this->pdo = $pdo;
    }

    public function storeInDatabase (MessageInterface $handler): void
    {
        try {
            $data = [
                'message_type' => $handler->getMessage()->getType(),
                'message' => $handler->getMessage()->getBody(),
                'priority' => $handler->getMessage()->getPriority(),
                'receiver' => $handler->getMessage()->getReceiver(),
                'message_type_special_value' => $handler->getCalculatedUniqueValue()
            ];

            $this->pdo->connect()->prepare($this->sql())->execute($data);
            $this->pdo->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "data inserted successfully\n";
        } catch(PDOException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }

    private function sql(): string
    {
        return "
            INSERT INTO message (
                message_type,
                message,
                priority,
                receiver,
                message_type_special_value
            ) 
            VALUES (
               :message_type,
               :message,
               :priority,
               :receiver,
               :message_type_special_value
            )
        ";
    }
}
<?php

namespace Recman\db;

use PDO;
use PDOException;

class Connection
{
    private PDO $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

//    public function connect(): void
//    {
//        try {
//            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
//        } catch(PDOException $e) {
//            echo "Connection failed: " . $e->getMessage();
//        }
//
//        $data = [
//            'message_type' => 'error',
//            'message' => 'sdfsdfsdfhgfy5retgdf',
//        ];
//
//        $sql = "INSERT INTO message (message_type, message) VALUES (:message_type, :message)";
//        $this->connection->prepare($sql)->execute($data);
//    }

    public function connect(): PDO
    {
        return $this->connection;
    }


}
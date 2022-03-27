<?php

namespace Recman\Mapper;

class ReceiverMapper
{
    private const DEFAULT_RECEIVER = 1;

    private array $mapped;

    public function __construct(array $mapped)
    {
        $this->mapped = $mapped;
    }

    public function map(string $key): int
    {
        if (array_key_exists($key, $this->mapped)) {
            return $this->mapped[$key];
        }
        return self::DEFAULT_RECEIVER;
    }
}

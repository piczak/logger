<?php

namespace Recman\Mapper;

class PriorityMapper
{
    private const DEFAULT_PRIORITY = 1;

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
        return self::DEFAULT_PRIORITY;
    }
}

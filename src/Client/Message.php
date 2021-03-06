<?php

namespace Minions\Client;

class Message extends Notification
{
    /**
     * Message ID.
     *
     * @var int|string
     */
    protected $id;

    /**
     * Construct a new Notification.
     *
     * @param int|string $id
     */
    public function __construct(string $method, array $parameters, $id)
    {
        parent::__construct($method, $parameters);

        $this->id = $id;
    }

    /**
     * Message ID.
     *
     * @return int|string|null
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Convert to array.
     */
    public function toArray(): array
    {
        return \array_filter([
            'jsonrpc' => $this->version(),
            'method' => $this->method(),
            'params' => $this->parameters(),
            'id' => $this->id(),
        ]);
    }

    /**
     * Convert to JSON.
     */
    public function toJson(): string
    {
        return \json_encode($this->toArray());
    }
}

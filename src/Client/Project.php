<?php

namespace Minions\Client;

use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface as ResponseContract;

class Project
{
    /**
     * Application ID for the client.
     *
     * @var string
     */
    protected $id;

    /**
     * Project configuration.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The browser implementation.
     *
     * @var \Clue\React\Buzz\Browser
     */
    protected $browser;

    /**
     * Construct a new project.
     */
    public function __construct(string $id, array $config, Browser $browser)
    {
        $this->id = $id;
        $this->config = $config;
        $this->browser = $browser;
    }

    /**
     * Broadcast message.
     *
     * @return \React\Promise\PromiseInterface
     */
    public function broadcast(MessageInterface $message)
    {
        $headers = [
            'Content-Type' => 'application/json',
            'X-Request-ID' => $this->id,
        ];

        if (! \is_null($this->config['token'] ?? null)) {
            $headers['Authorization'] = "Token {$this->config['token']}";
        }

        if (! \is_null($this->config['signature'] ?? null)) {
            $headers['X-Signature'] = $message->signature($this->config['signature'] ?? '');
        }

        return $this->browser->post('', $headers, $message->toJson())
            ->then(static function (ResponseContract $response) use ($message) {
                return (new Response($response))->validate($message);
            });
    }
}

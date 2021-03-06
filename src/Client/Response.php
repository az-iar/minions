<?php

namespace Minions\Client;

use Minions\Exceptions\ClientHasError;
use Minions\Exceptions\ServerHasError;
use Psr\Http\Message\ResponseInterface as ResponseContract;
use Serializable;

class Response implements ResponseInterface, Serializable
{
    /**
     * The PSR-7 Response implementation. The value can be null
     * when retrieving the instance from Serializeable.
     *
     * @var \Psr\Http\Message\ResponseInterface|null
     */
    protected $original;

    /**
     * The response body.
     *
     * @var array|null
     */
    protected $content = [
        'jsonrpc' => '2.0',
    ];

    /**
     * Construct response from PSR-7 Response.
     */
    public function __construct(ResponseContract $response)
    {
        $this->original = $response;

        $statusCode = $response->getStatusCode();

        if (\in_array($statusCode, [200, 201, 202])) {
            $this->content = \json_decode((string) $response->getBody(), true);
        } elseif (! \in_array($statusCode, [204, 205])) {
            $this->content['error'] = [
                'message' => $response->getReasonPhrase(),
                'code' => -32600,
                'data' => [
                    'status' => $statusCode,
                    'body' => (string) $response->getBody(),
                ],
            ];
        }
    }

    /**
     * Validate response.
     *
     * @return $this
     */
    public function validate(MessageInterface $message)
    {
        if (! \is_null($errorCode = $this->getRpcErrorCode())) {
            if (\in_array($errorCode, [-32600, -32601, -32602, -32700])) {
                throw new ClientHasError($this->getRpcErrorMessage(), $errorCode, $this, $message->method());
            } else {
                throw new ServerHasError($this->getRpcErrorMessage(), $errorCode, $this, $message->method());
            }
        }

        return $this;
    }

    /**
     * Get RPC ID.
     *
     * @return string|int|null
     */
    public function getRpcId()
    {
        return $this->content['id'] ?? null;
    }

    /**
     * Get RPC result.
     *
     * @return mixed
     */
    public function getRpcResult()
    {
        return $this->content['result'] ?? null;
    }

    /**
     * Get RPC version.
     */
    public function getRpcVersion(): string
    {
        return $this->content['jsonrpc'];
    }

    /**
     * Get RPC error exception name.
     */
    public function getRpcError(): ?string
    {
        return $this->content['error']['exception'] ?? null;
    }

    /**
     * Get RPC error code.
     */
    public function getRpcErrorCode(): ?int
    {
        return $this->content['error']['code'] ?? null;
    }

    /**
     * Get RPC error message.
     */
    public function getRpcErrorMessage(): ?string
    {
        return $this->content['error']['message'] ?? null;
    }

    /**
     * Get RPC error data.
     *
     * @return mixed
     */
    public function getRpcErrorData()
    {
        return $this->content['error']['data'] ?? null;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->content;
    }

    /**
     * Serialize instance.
     *
     * @return string
     */
    public function serialize()
    {
        return \serialize(['content' => $this->content]);
    }

    /**
     * Unserialize instance.
     *
     * @param string $data
     *
     * @return void
     */
    public function unserialize($data)
    {
        ['content' => $this->content] = \unserialize($data);
    }
}

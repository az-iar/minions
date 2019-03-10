<?php

namespace Minions\Exceptions;

use Datto\JsonRpc\Exception as JsonRpcException;
use Exception;

/**
 * Exception representing an invalid authentication/authorization attempt.
 * The error code corresponds to the JSON-RPC AuthX extension.
 *
 * @author Chad Kosie <ckosie@datto.com>
 */
class InvalidToken extends Exception implements JsonRpcException
{
    public function __construct()
    {
        parent::__construct('Invalid auth.', -32652);
    }
}
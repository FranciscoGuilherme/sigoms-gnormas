<?php

namespace App\MessageBus\Message;

use Amp\Loop;
use Amp\Delayed;
use Amp\Websocket;
use Amp\Websocket\Client;

/**
 * @package App\MessageBus\Message
 */
final class StandardMessage
{
    /**
     * @var string $desc
     */
    private string $desc;

    /**
     * @param string $desc
     */
    public function __construct(string $desc)
    {
        $this->desc = $desc;
    }

    /**
     * @return string
     */
    public function getDesc(): string
    {
        return $this->desc;
    }
}
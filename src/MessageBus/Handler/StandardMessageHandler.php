<?php

namespace App\MessageBus\Handler;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\MessageBus\Message\StandardMessage;

/**
 * @package App\MessageBus\Handler
 */
class StandardMessageHandler implements MessageHandlerInterface
{
    /**
     * @param StandardMessage $processMessage
     */
    public function __invoke(StandardMessage $standardMessage)
    {
        echo $standardMessage->getDesc();
    }
}
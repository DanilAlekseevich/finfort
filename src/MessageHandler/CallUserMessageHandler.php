<?php

namespace App\MessageHandler;

use App\Message\CallUserMessage;
use App\Service\CallService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CallUserMessageHandler
{
    public function __construct(private readonly CallService $callService)
    {
    }
    
    public function __invoke(CallUserMessage $message): void
    {
        $this->callService->callUser($message->user);
    }
    
}
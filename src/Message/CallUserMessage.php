<?php

namespace App\Message;

use App\DTO\UserDTO;

class CallUserMessage
{
    public function __construct(
        public readonly UserDTO $user,
    )
    {
    }
}
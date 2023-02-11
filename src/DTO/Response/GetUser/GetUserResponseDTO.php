<?php

namespace App\DTO\Response\GetUser;

use App\DTO\UserDTO;
use Symfony\Component\Serializer\Annotation\Context;

class GetUserResponseDTO
{
    /**
     * @var \App\DTO\UserDTO[]
     */
    public array $response;
}
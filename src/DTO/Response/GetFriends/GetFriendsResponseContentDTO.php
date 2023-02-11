<?php

namespace App\DTO\Response\GetFriends;

use App\DTO\UserDTO;

class GetFriendsResponseContentDTO
{
    public int $count;
    
    /**
     * @var UserDTO[]
     */
    public array $items;
}
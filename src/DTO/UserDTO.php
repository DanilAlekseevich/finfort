<?php

namespace App\DTO;

class UserDTO
{
    public int $id;
    
    public string $first_name;
    
    public string $last_name;
    
    public int $online;
    
    public bool $can_access_closed;
    
    public bool $is_closed;
    
}
<?php

namespace App\Repository;

use App\Entity\Call;

interface CallRepositoryInterface
{
    public function saveCall(Call $call): void;
}
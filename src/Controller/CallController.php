<?php

namespace App\Controller;

use App\DTO\UserDTO;
use App\Message\CallUserMessage;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CallController extends AbstractController
{
    public function __construct(
        private readonly UserService $userService,
        private readonly MessageBusInterface $bus,
    )
    {
    }
    
    #[Route(path: '/api/v1/call/friends/by/userId/{userId}', methods: ['GET'])]
    public function callFriendsByUserId(int $userId): JsonResponse
    {
        $user = new UserDTO();
        $user->id = $userId;
        
        $friends = $this->userService->getFriendsByUser($user);
        foreach ($friends as $user) {
            $this->bus->dispatch(new CallUserMessage($user));
        }
        
        return $this->json("В ближайшее время всем друзям поступит звонок!");
    }
}
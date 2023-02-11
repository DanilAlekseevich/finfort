<?php

namespace App\Service;

use App\DTO\Response\GetFriends\GetFriendsResponseDTO;
use App\DTO\UserDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UserService
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly SerializerInterface $serializer,
    ) {
    }
    
    /**
     * @return UserDTO[]
     */
    public function getFriendsByUser(UserDTO $user): array
    {
        $accessToken = $_ENV['SERVICE_ACCESS_KEY'];
        
        $response = $this->httpClient->request(
            Request::METHOD_GET,
            "https://api.vk.com/method/friends.get?v=5.131&access_token={$accessToken}&user_id={$user->id}&fields=online"
        );
        
        $responseDTO = $this->serializer->deserialize(
            $response->getContent(),
            GetFriendsResponseDTO::class,
            JsonEncoder::FORMAT
        );
        
        
        return $responseDTO->response->items;
    }
}
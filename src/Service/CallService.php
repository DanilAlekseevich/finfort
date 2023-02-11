<?php

namespace App\Service;

use App\DTO\Response\GetUser\GetUserResponseDTO;
use App\DTO\UserDTO;
use App\Entity\Call;
use App\Repository\CallRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallService
{
    public function __construct(
        private readonly CallRepositoryInterface $callRepository,
        private readonly HttpClientInterface $httpClient,
        private readonly SerializerInterface $serializer,
    ) {
    }
    
    public function callUser(UserDTO $user): void
    {
        
        $accessToken = $_ENV['SERVICE_ACCESS_KEY'];
        
        $response = $this->httpClient->request(
            Request::METHOD_GET,
            "https://api.vk.com/method/users.get?v=5.131&access_token={$accessToken}&user_id={$user->id}&fields=online"
        );
        
        /**
         * @var GetUserResponseDTO $responseDTO
         */
        $responseDTO = $this->serializer->deserialize(
            $response->getContent(),
            GetUserResponseDTO::class,
            JsonEncoder::FORMAT,
        );
        
        
        $this->saveCallResultByOnlineUserStatus(array_shift($responseDTO->response));
    }
    
    private function saveCallResultByOnlineUserStatus(UserDTO $user): void
    {
        $result = match ($user->online) {
            1 => 'success',
            default => 'error'
        };
        
        $call = new Call();
        $call->setVkId($user->id);
        $call->setResult($result);
        $call->setCallDateTime(new \DateTime('now'));
        
        $this->callRepository->saveCall($call);
    }
}
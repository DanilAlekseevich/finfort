<?php

namespace App\Command;

use App\DTO\UserDTO;
use App\Message\CallUserMessage;
use App\Service\UserService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(name: 'call:friends', description: 'Позвонить друзьям пользователя')]
class CallFriendsByUserCommand extends Command
{
    public function __construct(
        private readonly UserService $userService,
        private readonly MessageBusInterface $bus,
    )
    {
        parent::__construct();
    }
    
    protected function configure()
    {
        $this->addArgument('userId', InputArgument::REQUIRED, 'ID пользователя VK');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $user = new UserDTO();
        $user->id = (int)$input->getArgument('userId');
        
        $friends = $this->userService->getFriendsByUser($user);
        foreach ($friends as $user) {
            $this->bus->dispatch(new CallUserMessage($user));
        }
        
        return Command::SUCCESS;
    }
}
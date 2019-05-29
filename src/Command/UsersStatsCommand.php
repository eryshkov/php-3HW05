<?php

namespace App\Command;

use App\Repository\UserRepository;
use App\Services\Mailer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class UsersStatsCommand extends Command
{
    protected static $defaultName = 'users:stats';
    /**
     * @var UserRepository
     */
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct(null);
        $this->userRepository = $userRepository;
    }
    
    protected function configure()
    {
        $this
            ->setDescription('Mails number of users')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
    
        $usersCount = $this->userRepository->count([]);
        
        $mailer = new Mailer();
    
        $mailer->mail('Users report', 'You have ' . $usersCount . ' user(s)');

        $io->success('Email was sent successfully');
    }
}

<?php

namespace App\Command;

use App\Repository\UserRepository;
use App\Services\Mailer;
use Swift_Mailer;
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
    /**
     * @var Swift_Mailer
     */
    private $mailer;
    
    public function __construct(UserRepository $userRepository, Swift_Mailer $mailer)
    {
        parent::__construct(null);
        $this->userRepository = $userRepository;
        $this->mailer = $mailer;
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
    
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('dwebbo@bk.ru')
            ->setTo('eryshkov@gmail.com')
            ->setBody('You have ' . $usersCount . ' user(s)');
            
        $result = $this->mailer->send($message);
    
        if (0 !== $result) {
            $io->success('Email was sent successfully: ' . $result);
        } else {
            $io->error('Email was not sent');
        }
    }
}

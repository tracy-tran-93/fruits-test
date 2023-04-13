<?php

namespace App\Command;

use App\Entity\Fruit;
use App\Service\FruitService;
use App\Service\HTTPService;
use App\Service\MailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;

#[AsCommand(
    name: 'fruits:fetch',
    description: 'Command get fruits from API and save it to database then send notification through mail',
)]
class GetListFruitCommand extends Command
{
    protected EntityManagerInterface $entityManager;
    protected MailService $mailService;
    protected FruitService $fruitService;
    public function __construct(
        EntityManagerInterface $entityManager,
        MailService $mailService,
        FruitService $fruitService
    )
    {
        $this->entityManager = $entityManager;
        $this->mailService = $mailService;
        $this->fruitService = $fruitService;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $client = HttpClient::create();
        $httpService = new HTTPService($client);
        try {
            $res = $httpService->fetchFruitsFromAPI();
            $fruits = $res['content'];
            $allFruitExistInDb = $this->fruitService->getAllFruitName($this->entityManager);
            $duplicateFruits = $successFruits = [];
            //handle save data into fruits table.
            foreach ($fruits as $fruit) {
                if (in_array($fruit['name'], $allFruitExistInDb)) {
                    $duplicateFruits[] = $fruit['name'];
                } else {
                    $fruitModel = new Fruit();
                    $fruitModel->setName($fruit['name']);
                    $fruitModel->setFamily($fruit['family']);
                    $fruitModel->setGenus($fruit['genus']);
                    $fruitModel->setType($fruit['order']);
                    $fruitModel->setNutritions($fruit['nutritions']);
                    $this->entityManager->persist($fruitModel);
                    $successFruits[] = $fruit['name'];
                }

            }

            $this->entityManager->flush();
            //send mail
            $this->mailService->sendMail($res['error'], $duplicateFruits, $successFruits);
            $io->success('Command to fetch fruits run successfully');


        } catch (\Exception $exception) {
            $io->error('Fail to save data  : ' . $exception->getMessage());
        }

        return Command::SUCCESS;
    }
}

<?php
namespace App\Service;


use App\Entity\Fruit;
use App\Repository\FruitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class FruitService
{
    private $fruiteRepo;
    public function __construct(FruitRepository $fruiteRepo)
    {
        $this->fruiteRepo = $fruiteRepo;
    }

    /**
     * Handle search list fruit.
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $query = $request->query->get('query', '');
        $page = $request->query->getInt('page', 1);
        $limit = $request->query->getInt('limit', 10);

        $fruits =  $this->fruiteRepo->search($query, $page, $limit);
        return $fruits;
    }

    /**
     * Get All Name of fruite table
     * @param EntityManagerInterface $entityManager
     * @return array
     */
    public function getAllFruitName(EntityManagerInterface $entityManager): array
    {
        $allFruitExistInDb = $entityManager->getRepository(Fruit::class)->findAll();
        $name = [];
        foreach ($allFruitExistInDb as $fruit) {
            $name[] = $fruit->getName();
        }

        return $name;
    }
}
<?php

namespace App\Repository;

use App\Entity\Fruit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * @extends ServiceEntityRepository<Fruit>
 *
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fruit::class);
    }

    public function save(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param string $name
     * @param string $family
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function search(string $query, int $page, int $limit): array
{
    $queryBuilder = $this->createQueryBuilder('f')
        ->select('f');
    //handle search name & family.
    if ($query) {
        $queryBuilder
            ->where('f.name LIKE :query')
            ->orWhere('f.family LIKE :query')
            ->setParameter('query', '%' . $query . '%');
    }
    //pagniate
    $queryBuilder
        ->setFirstResult(($page - 1) * $limit)
        ->setMaxResults($limit);

    $paginator = new Paginator($queryBuilder);
    //get total records
    $totalRecords = $paginator->count();

    return [
        'total_records' => $totalRecords,
        'fruits' => $paginator->getIterator()->getArrayCopy(),
    ];
}
}

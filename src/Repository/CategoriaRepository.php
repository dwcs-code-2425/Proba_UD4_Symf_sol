<?php

namespace App\Repository;

use App\Entity\Categoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Categoria>
 */
class CategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Categoria::class);
    }

    public function findAllOrderedByName(): array
{
    return $this->createQueryBuilder('c')
        ->orderBy('c.nombre', 'ASC') // Ordena por nombre en orden ascendente
        ->getQuery()
        ->getResult();
}
}

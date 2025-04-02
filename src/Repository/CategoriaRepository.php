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

    public function findAllOrderedByName2(): array
    {
//Esto también funcionaría, pero devuelve una colección de arrays de 2 elementos por cada categoría en lugar de un array de objetos Categoría
        return $this->getEntityManager()->createQuery("SELECT c.nombre, c.id from App\Entity\Categoria c ORDER BY c.nombre")->getResult();
    }

    public function findAllOrderedByName3(): array
    {
//Esto también funcionaría, pero devuelve una colección de arrays de 2 elementos por cada categoría en lugar de un array de objetos Categoría
        return $this->getEntityManager()->createQuery("SELECT c from App\Entity\Categoria c ORDER BY c.nombre")->getResult();
    }
}

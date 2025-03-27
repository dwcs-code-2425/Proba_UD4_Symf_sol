<?php

namespace App\Repository;

use App\Entity\Producto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Producto>
 */
class ProductoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Producto::class);
    }

  

    public function buscarProductos(?string $termino, ?int $categoriaId)
    {
        $qb = $this->createQueryBuilder('p');

        if ($termino) {
            $qb->andWhere('p.nombre LIKE :termino')
                ->setParameter('termino', "%$termino%");
        }

        if ($categoriaId) {
            $qb->andWhere('p.categoria = :categoria')
                ->setParameter('categoria', $categoriaId);
        }

        return $qb->getQuery()->getResult();
    }
}

<?php
namespace App\Service;

use App\Repository\CategoriaRepository;
use App\Repository\ProductoRepository;
use Doctrine\ORM\EntityManagerInterface;


class ProductoService{
    //Constructor Promotion : https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion
    public function __construct(private EntityManagerInterface $entityManagerInterface, private ProductoRepository $produtoRepository,
     private CategoriaRepository $categoriaRepository) {
        
    }


    public function buscarProductos(?string $termino, ?int $categoriaId)
    {
        return $this->produtoRepository->buscarProductos($termino, $categoriaId);
    }

    public function getAllCategories(){
        return $this->categoriaRepository->findAllOrderedByName();

    }
}
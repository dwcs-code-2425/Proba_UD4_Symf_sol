<?php

namespace App\Controller;

use App\Repository\CategoriaRepository;
use App\Repository\ProductoRepository;
use App\Service\ProductoService;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

final class ProductoController extends AbstractController
{


    #[Route('/producto/buscar', name: 'producto_buscar')]
    public function buscar(Request $request, ProductoService $productoService): Response
    {
        try {

            $categorias = $productoService->getAllCategories();
            $parametersToView = ['categorias' => $categorias];

            //Se hace la búsqueda si vienen en la URL parámetros de búsqueda
            if ($request->query->count() > 0) {

                //Recupera de la URL el texto y el id de la categoría introducida. Si el 

                $termino = $request->query->get('termino', '');
                $categoriaId = $request->query->get('categoria', null);


                if ($categoriaId == "")
                    $categoriaId = null;
                $productos = $productoService->buscarProductos($termino, $categoriaId);

                $parametersToView["productos"] = $productos;
            }

         



            return $this->render(
                'producto/busqueda.html.twig',
                $parametersToView
    
    
            );
        }
        catch(Throwable $th){
            $this->addFlash("danger", "Ocurrió un problema inesperado y no se ha podido realizar la operación");
            return $this->render(
                'producto/busqueda.html.twig'
            );
        }
        



      
    }
}

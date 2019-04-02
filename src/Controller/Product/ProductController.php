<?php

namespace App\Controller\Product;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Form\admin\ProductType;
use App\Entity\ProductTemplate;
use App\Services\ProductService;


class ProductController extends AbstractController
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function listProductsAction(Request $request)
    {
        $products = $this->productService->getProducts();

        return $this->render('/product/list_product.html.twig', ['products' => $products]);
    }

    public function createProductAction(Request $request)
    {
        $productTemplate = new ProductTemplate();
        $productForm = $this->createForm(ProductType::class, $productTemplate);

        $productForm->handleRequest($request);

        if ($productForm->isSubmitted() and $productForm->isValid()) {
            $productId = $this->productService->createProduct($productForm->getData());

            if ($productId) {
                return $this->redirectToRoute('admin_dashboard');
            }
        }

        return $this->render('/product/create_product.html.twig', ['form' => $productForm->createView()]);
    }
}
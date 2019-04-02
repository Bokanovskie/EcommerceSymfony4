<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ProductTemplate;
use Doctrine\Common\Persistence\ManagerRegistry;

class ProductService
{
    private $entityManager;

    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry, EntityManagerInterface $entityManager)
    {
        $this->managerRegistry = $managerRegistry;
        $this->entityManager = $entityManager;
    }

    public function getProducts()
    {
        $productRepository = $this->managerRegistry->getRepository(ProductTemplate::class);

        return $productRepository->findAll();

    }

    public function createProduct(ProductTemplate $product)
    {

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        if ($product->getId()) {
            return $product->getId();
        }

        return false;
    }
}
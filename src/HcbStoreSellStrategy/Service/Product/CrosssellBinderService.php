<?php
namespace HcbStoreSellStrategy\Service\Product;

use Doctrine\ORM\EntityManagerInterface;
use HcbStoreProduct\Entity\Product\IdentifierInterface;
use HcbStoreSellStrategy\Data\Product\CrosssellInterface;
use HcbStoreSellStrategy\Entity\SellStrategy\Product;

class CrosssellBinderService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param CrosssellInterface $crosssellData
     * @param IdentifierInterface $productEntity
     *
     * @throws \Exception
     */
    public function bind(CrosssellInterface $crosssellData,
                         IdentifierInterface $productEntity)
    {
        try {
            $this->entityManager->beginTransaction();

            $data = $crosssellData->getCrosssell();

            $results = $this->entityManager
                ->getRepository
                ('HcbStoreSellStrategy\Entity\SellStrategy\Product')
                ->findBy(array('sellProduct'=>$productEntity->getId()));

            foreach ($results as $item) {
                $this->entityManager->remove($item);
            }

            $this->entityManager->flush();

            if (empty($data)) {
                $this->entityManager->commit();
                return;
            }

            foreach ($data as $productId) {
                $productId = intval(trim($productId));
                $sellStrategyProductEntity = new Product();
                $sellStrategyProductEntity
                    ->setSellStrategy($this->entityManager
                        ->getReference
                        ('HcbStoreSellStrategy\Entity\SellStrategy', 1))
                    ->setSellProduct($this->entityManager
                        ->getReference
                        ('HcbStoreProduct\Entity\Product',
                            $productEntity->getId()))
                    ->setProduct($this->entityManager
                        ->getReference
                        ('HcbStoreProduct\Entity\Product',
                            $productId));

                $this->entityManager->persist($sellStrategyProductEntity);
            }

            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->entityManager->rollback();
            throw $e;
        }
    }
}

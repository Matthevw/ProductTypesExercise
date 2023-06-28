<?php

namespace M2M\ProductTypesExercise\Model\Simple;

use \Magento\Catalog\Model\ProductFactory as ProductModel;
use \Magento\Catalog\Model\ResourceModel\Product as ProductResourceModel;
use \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory as ProductCollection;

use M2M\Logger\Logger\Logger;

class Product
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var ProductModel
     */
    protected $productModel;

    /**
     * @var ProductResourceModel
     */
    protected $productResourceModel;

    /**
     * @var ProductCollection
     */
    protected $productCollection;

    public function __construct(
        ProductModel $productModel,
        ProductResourceModel $productResourceModel,
        ProductCollection $productCollection,
        Logger $logger,
    ) {
        $this->productModel = $productModel;
        $this->productResourceModel = $productResourceModel;
        $this->productCollection = $productCollection;
        $this->logger = $logger;
        }

    public function addProduct() {
        
        $product = $this->productModel->create();

        $sku = '73827';
        
        $product->setSku($sku)
            ->setName('Aligator')
            ->setPrice('900')
            ->setVisibility(4)
            ->setStatus(1);

        $this->productResourceModel->save($product);

        $this->getProduct($sku);
    }

    public function getProduct(string $sku) {
        
        $collection = $this->productCollection->create()->addAttributeToFilter('sku', ['eq' => $sku])->getData();

        if ($collection){
            print(print_r($collection,true)); die;
        } else {
            print("Nie ma takiego produktu w bazie");
            $this->logger->info("Nie ma takiego produktu w bazie");
        }
    }
}
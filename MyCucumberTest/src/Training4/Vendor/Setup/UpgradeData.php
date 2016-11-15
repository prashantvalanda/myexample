<?php

namespace Training4\Vendor\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{

    
    private $collectionFactory = null;

   
    public function __construct(\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

   
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '2.0.2', '<')) {

            $collection = $this->collectionFactory->create();

            foreach ($collection as $product) {

                $data = [
                    'vendor_id' => mt_rand(1, 2),
                    'product_id' => $product->getId(),
                ];
                $setup->getConnection()->insert('training4_vendor2product', $data);
            }
        }

        $setup->endSetup();
    }
}
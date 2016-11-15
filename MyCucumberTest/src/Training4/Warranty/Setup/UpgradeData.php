<?php

namespace Training4\Warranty\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
   
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
       $this->eavSetupFactory = $eavSetupFactory;
    }

   
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        if (version_compare($context->getVersion(), '2.0.1', '<')) {
			
			$entityType = $eavSetup->getEntityTypeId('catalog_product');			
			
            $eavSetup->addAttributeSet($entityType, 'Gear', 4);
			
			$setId = $eavSetup->getAttributeSetId($entityType, 'Gear');
			$groupId = $eavSetup->getAttributeGroupId($entityType, $setId, 'General');
			$attributeId = $eavSetup->getAttributeId($entityType, 'warranty');
			
			$eavSetup->addAttributeToSet($entityType, $setId, $groupId, $attributeId, 100);
        }
    }
}
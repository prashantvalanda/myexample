<?php

namespace Training4\Vendor\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
		
        $connection = $setup->getConnection();

        if (version_compare($context->getVersion(), '2.0.2', '<')) {

            $table = $connection->newTable($setup->getTable('training4_vendor2product'))
				->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true],
                    'ID'
                )
                ->addColumn(
                    'vendor_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['identity' => false, 'nullable' => false, 'primary' => true],
                    'Vendor ID'
                )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['identity' => false, 'nullable' => false, 'primary' => true],
                    'Product ID'
                )
                ->setComment(
                    'Vendor Product Table'
                );
            $connection->createTable($table);
          
        }

        $setup->endSetup();
    }
}
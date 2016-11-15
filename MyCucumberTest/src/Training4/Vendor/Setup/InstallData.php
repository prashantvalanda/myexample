<?php

namespace Training4\Vendor\Setup;

use Training4\Vendor\Model\Vendor;
use Training4\Vendor\Model\VendorFactory;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    
    private $vendorFactory;

    
    public function __construct(VendorFactory $vendorFactory)
    {
        $this->vendorFactory = $vendorFactory;
    }

    
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $vendors = [
            [
				'name' => 'A Vendor'
            ],
            [
                'name' => 'B Vendor'
            ],
			[
				'name' => 'C Vendor'
            ],
            [
                'name' => 'D Vendor'
            ],
			[
				'name' => 'D Vendor'
            ],
            [
                'name' => 'E Vendor'
            ],
        ];

		
       
        foreach ($vendors as $data) {
			$vendorModel = $this->vendorFactory->create();
            $vendorModel->setData($data)->save();
        }

        $setup->endSetup();
    }
}
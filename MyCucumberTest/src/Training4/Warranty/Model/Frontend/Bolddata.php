<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

// @codingStandardsIgnoreFile

namespace Training4\Warranty\Model\Frontend;

class Bolddata extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
   

	
   
    public function getValue(\Magento\Framework\DataObject $object)
    {
		$this->getAttribute()->setData(\Magento\Catalog\Model\ResourceModel\Eav\Attribute::IS_HTML_ALLOWED_ON_FRONT, 1);
		
        $data = '';
        $value = parent::getValue($object);

        return "<b>". $value ."</b>";
    }
}

<?php

namespace Training4\VendorList\Model; 

class VendorList extends \Magento\Framework\Model\AbstractModel
{
    
    protected function _construct()
    {
        $this->_init('Training4\VendorList\Model\ResourceModel\VendorList');
    }

}
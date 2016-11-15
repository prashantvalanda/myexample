<?php

namespace Training4\Vendor\Model; 

class Vendor extends \Magento\Framework\Model\AbstractModel
{
    
    protected function _construct()
    {
        $this->_init('Training4\Vendor\Model\ResourceModel\Vendor');
    }

}
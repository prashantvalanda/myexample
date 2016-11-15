<?php

namespace Training4\Vendor\Model\ResourceModel;

class Vendor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
   
    protected function _construct()
    {
        $this->_init('training4_vendor', 'vendor_id');
    }
}
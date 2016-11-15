<?php

namespace Training4\VendorList\Model\ResourceModel;

class VendorList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
   
    protected function _construct()
    {
        $this->_init('training4_vendor2product', 'id');
    }
}
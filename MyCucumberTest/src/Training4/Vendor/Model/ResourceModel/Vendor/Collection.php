<?php

namespace Training4\Vendor\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'vendor_id';


    protected function _construct()
    {
        $this->_init('Training4\Vendor\Model\Vendor', 'Training4\Vendor\Model\ResourceModel\Vendor');
    }


}
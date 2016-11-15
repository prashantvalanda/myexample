<?php

namespace Training5\VendorRepository\Model\ResourceModel\Vendor;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'vendor_id';


    protected function _construct()
    {
        $this->_init('Training5\VendorRepository\Model\Vendor', 'Training5\VendorRepository\Model\ResourceModel\Vendor');
    }


}
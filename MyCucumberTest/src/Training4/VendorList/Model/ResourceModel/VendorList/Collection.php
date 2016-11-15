<?php

namespace Training4\VendorList\Model\ResourceModel\VendorList;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected $_idFieldName = 'id';


    protected function _construct()
    {
        $this->_init('Training4\VendorList\Model\VendorList', 'Training4\VendorList\Model\ResourceModel\VendorList');
    }


}
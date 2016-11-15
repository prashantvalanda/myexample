<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training6\Addevent\Model;


class Addevent extends \Magento\Framework\Model\AbstractModel
{
    
    protected function _construct()
    {
        $this->_init('Training6\Addevent\Model\ResourceModel\Addevent');
    }

}

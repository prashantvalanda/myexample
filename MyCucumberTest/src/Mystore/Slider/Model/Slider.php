<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Mystore\Slider\Model;


class Slider extends \Magento\Framework\Model\AbstractModel
{
    
    protected function _construct()
    {
        $this->_init('Mystore\Slider\Model\ResourceModel\Slider');
    }

}

<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Training6\Addevent\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 *  mysql resource
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Addevent extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('addevent', 'event_id');
    }
	
	

}

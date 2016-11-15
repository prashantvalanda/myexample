<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training4\Warranty\Model\Backend;

use Magento\Framework\App\ResourceConnection;
use Magento\Store\Model\ScopeInterface;
use Magento\UrlRewrite\Model\Storage\DbStorage;
use Magento\UrlRewrite\Service\V1\Data\UrlRewrite;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Changeyear extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{

    public function beforeSave($object)
    {
        $attributeName = $this->getAttribute()->getName();
		$value = $object->getData($attributeName).' year';
		$object->setData($attributeName, $value);
		return $this;
    }

}

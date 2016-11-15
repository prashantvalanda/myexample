<?php

namespace Training5\VendorRepository\Model;

use Magento\Framework\DataObject\IdentityInterface; 
use Training5\VendorRepository\Api\Data\VendorInterface; 

class Vendor extends \Magento\Framework\Model\AbstractModel implements VendorInterface, IdentityInterface
{
	
	const CACHE_TAG = 'vendorlist';
    
    protected function _construct()
    {
        $this->_init('Training5\VendorRepository\Model\ResourceModel\Vendor');
    }
	
	public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
	
	/**
     * Get ID
     *
     * @return int
     */
	public function getVendorId()
    {
        return parent::getData('vendor_id');
    }
	
	/**
	 * Get name
	 *
	 * @return string
	 */    
    public function getName()
    {
        return $this->getData('name');
    }
	
	/**
     * Set ID
     *
     * @param int $id
     * @return \Training5\VendorRepository\Api\Data\VendorInterface
     */
	public function setVendorId($id)
    {
        return $this->setData('vendor_id', $id);
    }
	
	/**
     * Set title
     *
     * @param string $identifier
     * @return \Training5\VendorRepository\Api\Data\VendorInterface
     */    
    public function setName($identifier)
    {
        return $this->setData('name', $identifier);
    }

}
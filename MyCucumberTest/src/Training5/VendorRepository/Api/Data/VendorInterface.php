<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training5\VendorRepository\Api\Data;

interface VendorInterface
{    

	/**
     * Get ID
     *
     * @return int
     */
    public function getVendorId();
	
	/**
	 * Get name
	 *
	 * @return string
	 */
    public function getName();
	
	/**
     * Set ID
     *
     * @param int $id
     * @return \Training5\VendorRepository\Api\Data\VendorInterface
     */
	public function setVendorId($id);
	
	/**
     * Set title
     *
     * @param string $name
     * @return \Training5\VendorRepository\Api\Data\VendorInterface
     */
	public function setName($name);

    
}

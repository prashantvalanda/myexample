<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training5\VendorRepository\Api;


interface VendorRepositoryInterface
{
    /**
     * Save vendor.
     *
     * @param \Training5\VendorRepository\Api\Data\VendorInterface $vendor
     * @return \Training5\VendorRepository\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save($vendor);
	
	 /**
     * Retrieve vendor.
     *
     * @param int $vendorId
     * @return \Training5\VendorRepository\Api\Data\VendorInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
	public function load($vendorId);
	
	/**
     * Retrieve vendor matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training5\VendorRepository\Api\Data\VendorSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
	public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
	
	/**
     * Retrieve productids related to vendor.
     *
     * @param  $vendorId
     * @return array()
     * @throws \Magento\Framework\Exception\LocalizedException
     */
	public function getAssociatedProductcIds($vendorId);

}

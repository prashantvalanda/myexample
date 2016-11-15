<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace  Training5\VendorRepository\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for cms page search results.
 * @api
 */
interface VendorSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get pages list.
     *
     * @return \Training5\VendorRepository\Api\Data\VendorInterface[]
     */
    public function getItems();

    /**
     * Set pages list.
     *
     * @param \Training5\VendorRepository\Api\Data\VendorInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

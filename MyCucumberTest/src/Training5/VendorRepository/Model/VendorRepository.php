<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training5\VendorRepository\Model;

use Training5\VendorRepository\Api\Data;
use Training5\VendorRepository\Api\VendorRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Training5\VendorRepository\Model\ResourceModel\Vendor as ResourceVendor;
use Training5\VendorRepository\Model\ResourceModel\Vendor\CollectionFactory as VendorCollectionFactory;
use Training4\VendorList\Model\ResourceModel\VendorList\CollectionFactory as VendorListCollectionFactory;

use Magento\Store\Model\StoreManagerInterface;

/**
 * Class VendorRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class VendorRepository implements VendorRepositoryInterface
{
    /**
     * @var ResourceVendor
     */
    protected $resource;

    /**
     * @var vendorFactory
     */
    protected $vendorFactory;
	
	/**
	 * @var vendorlistFactory
	 */
    protected $vendorlistCollectionFactory;

    /**
     * @var VendorCollectionFactory
     */
    protected $VendorCollectionFactory;

    /**
     * @var Data\PageSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @var \Magento\Cms\Api\Data\PageInterfaceFactory
     */
    protected $dataPageFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    
    public function __construct(
        ResourceVendor $resource,
        \Training4\Vendor\Model\VendorFactory $vendorFactory,
        Data\VendorInterfaceFactory $dataPageFactory,
        VendorCollectionFactory $VendorCollectionFactory,
        VendorListCollectionFactory $VendorlistCollectionFactory,
		Data\VendorSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->vendorFactory = $vendorFactory;
        $this->VendorCollectionFactory = $VendorCollectionFactory;
        $this->vendorlistCollectionFactory = $VendorlistCollectionFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPageFactory = $dataPageFactory;
		$this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

     public function load($vendorId)
    {
        $vendor = $this->vendorFactory->create();
        $vendor->load($vendorId);
        if (!$vendor->getId()) {
            throw new NoSuchEntityException(__('Vendor with id "%1" does not exist.', $vendorId));
        }
        return $vendor;
    }
	
	public function getAssociatedProductcIds($vendorId){
		$collection = $this->vendorlistCollectionFactory->create();
		$collection->addFieldToFilter('vendor_id',$vendorId);
			$data = array();
			foreach($collection as $child){
				$data[] = $child->getProductId();
			}
		return $data;
		
	}
	
	
    public function save($vendor)
    {
        try {
            $this->resource->save($vendor);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the vendor: %1',
                $exception->getMessage()
            ));
        }
        return $vendor;
    }
	
	 public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->VendorCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        
        $pages = [];
        /** @var Page $pageModel */
        foreach ($collection as $pageModel) {
            $pageData = $this->dataPageFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $pageData,
                $pageModel->getData(),
                'Training5\VendorRepository\Api\Data\VendorInterface'
            );
            $pages[] = $this->dataObjectProcessor->buildOutputDataArray(
                $pageData,
                'Training5\VendorRepository\Api\Data\VendorInterface'
            );
        }
        $searchResults->setItems($pages);
        return $searchResults;
    }
	
}

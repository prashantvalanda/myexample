<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Training5\VendorRepository\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    protected $resultForwardFactory;
	
    protected $objectManager;
	protected $searchCriteriaBuilder;
	
	protected $filterBuilder;
	protected $filterGroupBuilder;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
		\Magento\Framework\ObjectManagerInterface $objectManager,
		\Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
		\Magento\Framework\Api\FilterBuilder $filterBuilder,
		\Magento\Framework\Api\Search\FilterGroupBuilder $filterGroupBuilder
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->objectManager = $objectManager;
		$this->searchCriteriaBuilder = $searchCriteriaBuilder;
		$this->filterBuilder         = $filterBuilder;
		$this->filterGroupBuilder    = $filterGroupBuilder;
        parent::__construct($context);
    }

    
    public function execute()
    {
		
		$repo = $this->objectManager->get('Training5\VendorRepository\Model\VendorRepository');
		
		//load vendor by repository
		$vendor = $repo->load(1);
		//echo $vendor->getName();
		$vendor->setName('Prashant');
		
		//save vendor by repository
		$repo->save($vendor);
		
        
         $filter1 = $this->filterBuilder->setField('name')
            ->setValue('%Prashant%')
            ->setConditionType('like')
            ->create();

		$filter2 = $this->filterBuilder->setField('name')
            ->setValue('%Test%')
            ->setConditionType('like')
            ->create();
			
		$filter_group = $this->filterGroupBuilder
				->addFilter($filter1)
				->addFilter($filter2)
				->create();
		
		$searchCriteria = $this->searchCriteriaBuilder->setFilterGroups([$filter_group])->create();
		$list = $repo->getList($searchCriteria);
		
		var_dump($list->getItems());exit('aaa');
		
		//*************Get associated product ids from vendorId*******
		$productIds = $repo->getAssociatedProductcIds($vendor->getId());
		//var_dump($productIds);exit;
		
    }
}

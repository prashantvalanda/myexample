<?php 

namespace Training4\Vendor\Block;

use Magento\Framework\View\Element\Template;

class Productvendor  extends Template
{
	public $collectionFactory;
	 
	public function __construct(
		Template\Context $context,
		\Magento\Framework\Registry $registry,
		\Training4\Vendor\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory,
		array $data = []
    ) {
		$this->_registry = $registry;
		$this->collectionFactory = $collectionFactory;
		parent::__construct($context, $data);
    }

	public function getProductAssignVendor(){		
		$id = $this->getCurrentProductId();
		$collection = $this->collectionFactory->create();
		$collection->getSelect()->joinLeft(
		   ['vendorproduct'=>$collection->getTable('training4_vendor2product')],
		   'main_table.vendor_id = vendorproduct.vendor_id',
		   ['product_id'=>'vendorproduct.product_id']);
		$collection->addFieldToFilter('product_id',$id);
		return $collection;
	}
	
	public function getCurrentProductId()
    {       
        $currentProduct = $this->_registry->registry('current_product');
		return $currentProduct->getId();
    }
}
?>
<?php 

namespace Training4\VendorList\Block;

use Magento\Framework\View\Element\Template;

class Index  extends Template
{
	public $collectionFactory;
	
	public $toolbar;
	
	public function __construct(
		Template\Context $context,
		\Training4\Vendor\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory,
		\Training4\VendorList\Block\Toolbar $toolbar,
		array $data = []
    ) {
		parent::__construct($context, $data);
		$this->collectionFactory = $collectionFactory;
		$this->toolbar = $toolbar;
    }

	public function getAllVendor(){
		$collection = $this->collectionFactory->create();
		$collection->setOrder($this->toolbar->getOrder(),$this->toolbar->getSortDirection());
		return $collection;		 
	}
	
	public function getVendorViewUrl($id){
		return $this->_storeManager->getStore()->getBaseUrl().'vendorlist/index/view/id/'.$id;
	}
}
?>
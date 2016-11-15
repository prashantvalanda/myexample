<?php 

namespace Training4\VendorList\Block;

use Magento\Framework\View\Element\Template;

class Toolbar  extends Template
{
	const ORDER_PARAM_NAME = 'vendorsort_order';
	
	const DIRECTION_PARAM_NAME = 'vendorsort_dir';
	
	public $collectionFactory;
	
	protected $request;
	
	public function __construct(
		Template\Context $context,
		\Training4\Vendor\Model\ResourceModel\Vendor\CollectionFactory $collectionFactory,
		\Magento\Framework\App\Request\Http $request,
		array $data = []
    ) {
		parent::__construct($context, $data);
		$this->collectionFactory = $collectionFactory;
		$this->request = $request;
    }
	
	public function getVendorUrl(){
		return $this->_storeManager->getStore()->getBaseUrl().'vendorlist/index/index/';
	}
	
	public function getDefaultOrder()
    {
        return 'name';
    }
	
	public function getDefaultDirection()
    {
        return 'asc';
    }
	
	public function getOrder()
    {
        if($this->request->getParam(self::ORDER_PARAM_NAME)){
			return $this->request->getParam(self::ORDER_PARAM_NAME);
		}else{
			return $this->getDefaultOrder();
		}
    }
	
	public function getSortDirection()
	{        
		if($this->request->getParam(self::DIRECTION_PARAM_NAME)){
			return $this->request->getParam(self::DIRECTION_PARAM_NAME);
		}else{
			return $this->getDefaultDirection();
		}
    }

}
?>
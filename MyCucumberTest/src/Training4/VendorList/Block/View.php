<?php 

namespace Training4\VendorList\Block;

use Magento\Framework\View\Element\Template;

class View  extends Template
{
	protected $collectionFactory;
	
	protected $request;
	
	protected $_productloader; 
	
	public function __construct(
		Template\Context $context,
		\Training4\VendorList\Model\ResourceModel\VendorList\CollectionFactory $collectionFactory,
		\Magento\Catalog\Model\ProductFactory $_productloader,
		\Magento\Framework\App\Request\Http $request,
		array $data = []
    ) {
		parent::__construct($context, $data);
		$this->request = $request;
		$this->_productloader = $_productloader;
		$this->collectionFactory = $collectionFactory;
    }

	public function getVendorProducts(){
		$id = $this->request->getParam('id');
		$collection = $this->collectionFactory->create();
		$collection->addFieldToFilter('vendor_id',$id);
		return $collection;		 
	}
	
	public function getProdutNameByID($id){
		$product = $this->_productloader->create()->load($id);
		return $product->getName();
	}
	
}
?>
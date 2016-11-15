<?php
namespace Training6\Addevent\Block;


class Addevent extends \Magento\Framework\View\Element\Template
{
	protected $_eventCollectionFactory;
	 
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Training6\Addevent\Model\ResourceModel\Addevent\CollectionFactory $eventCollectionFactory,
        array $data = []
    ) {
		$this->_eventCollectionFactory = $eventCollectionFactory;
        parent::__construct($context, $data);
        
    }
 
	
	public function getEvents(){
		//get values of current page
        $page=($this->getRequest()->getParam('p'))? $this->getRequest()->getParam('p') : 1;
		//get values of current limit
        $pageSize=($this->getRequest()->getParam('limit'))? $this->getRequest()->getParam('limit') : 5;

		$collection = $this->_eventCollectionFactory->create();
		$collection->addFieldToFilter('is_active',1);
		$collection->setPageSize($pageSize);
        $collection->setCurPage($page);
		$collection->getSelect()->order('main_table.start_time asc');
		return $collection;		
	}
	
	protected function _prepareLayout()
	{
		parent::_prepareLayout();
		$this->pageConfig->getTitle()->set(__('Events'));


		if ($this->getEvents()) {
			$pager = $this->getLayout()->createBlock(
				'Magento\Theme\Block\Html\Pager',
				'events.pager'
			)->setAvailableLimit(array(5=>5,10=>10,15=>15))->setShowPerPage(true)->setCollection(
				$this->getEvents()
			);
			$this->setChild('pager', $pager);
			$this->getEvents()->load();
		}
		return $this;
	}
	
	public function getPagerHtml()
	{
		return $this->getChildHtml('pager');
	}
	
	public function getImage($item){
		$path = $this->_storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		return $path.$item->getImage();
	}
	
}
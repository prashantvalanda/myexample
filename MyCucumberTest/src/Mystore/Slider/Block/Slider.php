<?php
namespace Mystore\Slider\Block;


class Slider extends \Magento\Framework\View\Element\Template
{
	protected $_sliderCollectionFactory;
	 
	public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mystore\Slider\Model\ResourceModel\Slider\CollectionFactory $sliderCollectionFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_sliderCollectionFactory = $sliderCollectionFactory;
    }
	
	public function getSlider(){
		$collection = $this->_sliderCollectionFactory->create();
		$collection->addFieldToFilter('is_active',1);
		return $collection;		
	}
	
	public function getSliderMediaUrl($item){
		$path = $this->_storeManager->getStore()->getBaseUrl(
                        \Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
		return $path.$item->getImage();
	}
	
}
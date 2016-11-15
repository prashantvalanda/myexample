<?php 

namespace Training3\BundleBlock\Block;

use Magento\Framework\View\Element\Template;

class BundleBlock  extends Template
{
	
	public function __construct(
		Template\Context $context,
		array $data = []
    ) {
		parent::__construct($context, $data);
    }

	public function getHelloWorld(){		
		return "Hello World";
	}
}
?>
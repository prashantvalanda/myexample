<?php 

namespace Training3\ExchangeRate\Block;

use Magento\Framework\View\Element\Template;

class ExchangeRate  extends Template
{
	protected $_curl;
	
	public function __construct(
		Template\Context $context,
		\Magento\Framework\HTTP\Client\Curl $curl,
		array $data = []
    ) {
		parent::__construct($context, $data);
        $this->_curl = $curl;
    }

	public function getExchangeRate(){		
		$url = "http://api.fixer.io/latest?base=USD";
		$this->_curl->get($url);
		$response = json_decode($this->_curl->getBody(), true);
		return $response['rates']['EUR'];
		 
	}
}
?>
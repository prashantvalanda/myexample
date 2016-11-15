<?php

namespace Training1\FreeGeoIp\Observer;

use Magento\Framework\Event\ObserverInterface;

class CheckVisitorIpObserver implements ObserverInterface {

    protected $logger;
	
    protected $objectManager;
	
	protected $_curl;

    public function __construct(
	\Psr\Log\LoggerInterface $logger, 
	\Magento\Framework\ObjectManagerInterface $objectManager,
	\Magento\Framework\HTTP\Client\Curl $curl) {
        $this->logger = $logger;
		$this->_curl = $curl;
        $this->objectManager = $objectManager;
    }

    public function execute(\Magento\Framework\Event\Observer $observer) {
		$visitorIp = $this->getVisitorIp();
		$url = "freegeoip.net/json/".$visitorIp;
		$this->_curl->get($url);
		$response = json_decode($this->_curl->getBody(), true);
		$countryName = $response['country_name'];
        $this->logger->debug($visitorIp."-->".$countryName);        
    }
	
	function getVisitorIp() {		
		$remoteAddress = $this->objectManager->create('Magento\Framework\HTTP\PhpEnvironment\RemoteAddress');
		return $remoteAddress->getRemoteAddress();
	}
}
<?php 

namespace Training2\OrderController\Block;

use Magento\Framework\View\Element\Template;

class Index  extends Template
{
	protected $_order;
	
	protected $resultJsonFactory;
	
	 public function __construct(
		Template\Context $context, 
		array $data = [],
		\Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
		\Magento\Sales\Model\Order $order
    ) {
		parent::__construct($context, $data);
        $this->_order = $order;
		$this->resultJsonFactory = $resultJsonFactory;
    }

	public function getOrderData($orderId){		
		$order = $this->_order->loadByIncrementId($orderId);
		$data = array();
		$data['grand_total'] = $order->getGrandTotal();
		$data['order_status'] = $order->getStatus();
		$data['total_invoiced'] = $order->getBaseTotalInvoiced();
		
		$orderItems = $order->getAllItems();
		
		foreach($orderItems as $child){
			$item = array();
			$item['id'] = $child->getId();
			$item['sku'] = $child->getSku();			
			$item['price'] = $child->getPrice();
			$data['item'][$child->getId()] = $item;
		}		
		
		return json_encode($data);
		 
	}
}
?>
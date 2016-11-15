<?php

namespace Training3\OrderInfo\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Training3\OrderInfo\Model\Orderinfo;
use Magento\Framework\Controller\ResultFactory;

class Index extends Action
{
    
    protected $orderInfo;

    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        Orderinfo $order,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        $this->orderInfo = $order;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
    }

   
    protected function _isJson()
    {
        return (int)$this->getRequest()->getParam('json', 0) === 1;
    }
   
    public function execute()
    {
        $id = (int)$this->getRequest()->getParam('order_id', 0);

        if (true === $this->_isJson()) {
            $resultJson = $this->resultJsonFactory->create();
            $resultJson->setData($this->orderInfo->getOrder($id));
            return $resultJson;
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}
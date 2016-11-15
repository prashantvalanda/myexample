<?php

namespace Training3\OrderInfo\Block;

use Training3\OrderInfo\Model\Orderinfo;

class OrderJson extends \Magento\Framework\View\Element\Template
{

    protected $orderInfo;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Orderinfo $orderInfo,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->orderInfo = $orderInfo;
    }

    public function getOrderInfo()
    {
        $id = (int)$this->getRequest()->getParam('order_id', 0);
        return $this->orderInfo->getOrder($id);
    }
}
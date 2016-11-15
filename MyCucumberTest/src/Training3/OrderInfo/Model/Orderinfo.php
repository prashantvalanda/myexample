<?php

namespace Training3\OrderInfo\Model;

use Magento\Sales\Api\OrderRepositoryInterface;

class Orderinfo
{
    
    protected $salesOrder;

    public function __construct(OrderRepositoryInterface $orderRepositoryInterface)
    {
        $this->salesOrder = $orderRepositoryInterface;
    }

    public function getOrder($id)
    {

        $order = $this->salesOrder->get($id);

        $items = [];
        foreach ($order->getItems() as $item) {
            $items[] = [
                'sku'     => $item->getSku(),
                'item_id' => $item->getId(),
                'price'   => $item->getPriceInclTax(),
            ];
        }

        $json = [
            'status'         => $order->getStatus(),
            'total'          => $order->getGrandTotal(),
            'total_invoiced' => $order->getTotalInvoiced(),
            'items'          => $items,
        ];
        return $json;
    }
}
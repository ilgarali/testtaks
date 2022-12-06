<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;

class OrderService
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function createOrder(OrderRequest $orderRequest)
    {
        $payload['order_date']             = $orderRequest->getOrderDate();
        $payload['number_of_bonds_bought'] = $orderRequest->getNumberOfBondsBought();
        $payload['bond_id']                = $orderRequest->getId();
        return $this->orderRepository->create($payload);
    }
}

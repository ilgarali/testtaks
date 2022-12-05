<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    public function __construct(private OrderRepository $orderRepository)
    {
    }
}

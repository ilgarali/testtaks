<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\BondResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\PayoutResource;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderController extends Controller
{
    public function __construct(private OrderService $orderService, private OrderRepository $orderRepository)
    {
    }

    public function store(int $id, OrderRequest $orderRequest): JsonResponse|OrderResource
    {
        try {
            $order = $this->orderService->createOrder($orderRequest);
            return new OrderResource($order);
        }catch (HttpException $exception){
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        }
    }

    public function bondOrderPayments(int $id)
    {
        try {
            $order = $this->orderRepository->getById($id, ['bond']);
            return new PayoutResource($order);
        }catch (HttpException $exception){
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\BondResource;
use App\Http\Resources\OrderResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class OrderController extends Controller
{

    public function store(int $id, OrderRequest $orderRequest): JsonResponse|OrderResource
    {
        try {
            return new OrderResource();
        }catch (HttpException $exception){
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        }
    }
}

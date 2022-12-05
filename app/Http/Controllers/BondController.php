<?php

namespace App\Http\Controllers;

use App\Http\Resources\BondResource;
use App\Repositories\BondRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BondController extends Controller
{
    public function __construct(private BondRepository $repository)
    {
    }

    public function bondPaymentDates(int $id): JsonResponse|BondResource
    {
        try {

            return new BondResource($this->repository->getById($id));
        }catch (HttpException $exception){
            return response()->json($exception->getMessage(), $exception->getStatusCode());
        }
    }
}

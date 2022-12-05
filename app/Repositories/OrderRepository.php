<?php

namespace App\Repositories;

use App\Models\Order;
use JetBrains\PhpStorm\Pure;

class OrderRepository extends BaseRepository
{
    #[Pure]
    public function __construct(private Order $model)
    {
        parent::__construct($this->model);
    }
}

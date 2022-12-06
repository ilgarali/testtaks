<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;

class OrderResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id'                         => $this->id,
            'order_date'                 => $this->order_date,
            'number_of_bonds_bought'     => $this->number_of_bonds_bought,
            'bond'                       => new BondResource($this->bond),
        ];
    }
}

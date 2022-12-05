<?php

namespace App\Repositories;

use App\Models\Bond;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;

class BondRepository extends BaseRepository
{
    #[Pure]
    public function __construct(private Bond $model)
    {
        parent::__construct($this->model);
    }
}

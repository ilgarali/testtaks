<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['bond_id', 'order_date', 'number_of_bonds_bought'];

    public function bond(): BelongsTo
    {
        return $this->belongsTo(Bond::class);
    }

}

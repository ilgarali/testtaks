<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    use HasFactory;
    protected $fillable = ['date_of_issue', 'last_circulation_date', 'price', 'frequency_of_payment',
        'period_of_calculation_of_percentages', 'coupon_rate'];
}

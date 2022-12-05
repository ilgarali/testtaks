<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bond>
 */
class BondFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $frequency_of_payment = [1,2,4,12] ;
        $period_of_calculation_of_percentages = [360,364,365];
        return [
            'date_of_issue'                        => Carbon::now()->addDays(rand(1,10)),
            'last_circulation_date'                => Carbon::now()->addMonths(rand(3,10)),
            'price'                                => rand(5,99),
            'frequency_of_payment'                 => $frequency_of_payment[array_rand($frequency_of_payment)],
            'period_of_calculation_of_percentages' => $period_of_calculation_of_percentages[array_rand($period_of_calculation_of_percentages)],
            'coupon_rate'                          => rand(0,100),
        ];
    }
}

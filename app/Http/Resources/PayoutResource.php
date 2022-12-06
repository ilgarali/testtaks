<?php

namespace App\Http\Resources;

use App\Helpers\CalculateDates;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PayoutResource extends JsonResource
{
    public static $wrap = null;
    public float $accumulatedInterest = 0;
    public float $period = 0;

    public function toArray($request): array
    {
        $this->calculateInterest();
        return [
            'payouts' => $this->calculateInterest()
        ];
    }

    public function calculateInterest(): array
    {
        $data = [];
        $calculateDates = new CalculateDates();
        $bond = $this->bond;

        $paymentDates = $calculateDates->calculate($bond->period_of_calculation_of_percentages,$bond->frequency_of_payment,
            $bond->date_of_issue, $bond->last_circulation_date);
        $previous= null;

        if (count($paymentDates) > 0){
            foreach ($paymentDates as $key => $paymentDate){
                if ($key == 0){
                    $this->period = Carbon::parse($paymentDate['date'])->diffInDays($this->order_date);
                    $previous = Carbon::parse($paymentDate['date'])->format('Y-m-d');

                }else {
                    $this->period = Carbon::parse($paymentDate['date'])->diffInDays($previous);
                    $previous = Carbon::parse($paymentDate['date'])->format('Y-m-d');

                }
                $this->accumulatedInterest = ($this->bond->price / 100 * $this->bond->coupon_rate) /
                    $this->bond->period_of_calculation_of_percentages * $this->period * $this->number_of_bonds_bought;
                $data[$key]['amount'] = $this->accumulatedInterest;
                $data[$key]['date'] = $paymentDate['date'];
            }

        }
        return $data;
    }
}

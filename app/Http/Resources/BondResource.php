<?php

namespace App\Http\Resources;

use App\Helpers\CalculateDates;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BondResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        $calculateDate = new CalculateDates();
        return [
            'dates' => $calculateDate->calculate($this->period_of_calculation_of_percentages,$this->frequency_of_payment,
            $this->date_of_issue, $this->last_circulation_date
            ),
        ];
    }

}

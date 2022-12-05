<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BondResource extends JsonResource
{
    public static $wrap = null;

    private float $periodDurationByDay = 0;
    private float $periodDurationByMonth = 0;
    private array $dates = [];
    public function toArray($request)
    {
        $this->calculate();
        return [
            'dates' => $this->dates
        ];
    }

    public function calculate()
    {
        switch ($this->period_of_calculation_of_percentages){
            case 360:
                $this->periodDurationByDay = 12 / $this->frequency_of_payment * 30;
                break;
            case 364:
                $this->periodDurationByDay = 364 / $this->frequency_of_payment;
                break;
            case 365:
                $this->periodDurationByMonth = 12 / $this->frequency_of_payment;
                break;
        }

        if ($this->periodDurationByDay != 0) {
            $nextPaymentDate = Carbon::parse($this->date_of_issue)->addDays($this->periodDurationByDay);
            $this->calculateByDate($nextPaymentDate, true);
        }
        if ($this->periodDurationByMonth != 0) {
            $nextPaymentDate = Carbon::parse($this->date_of_issue)->addMonths($this->periodDurationByMonth);

            $this->calculateByDate($nextPaymentDate, false);
        }


    }

    public function calculateByDate($nextPaymentDate, $day = true)
    {
        $i = 0;
        while ($nextPaymentDate < $this->last_circulation_date){
            if ($nextPaymentDate->format('D') == 'Sat') {
                $this->dates[$i]['date'] = $nextPaymentDate->addDays(2)->format('Y-m-d');
            }elseif ($nextPaymentDate->format('D') == 'Mon'){
                $this->dates[$i]['date'] = $nextPaymentDate->addDay()->format('Y-m-d');
            }else {
                $this->dates[$i]['date'] = $nextPaymentDate->format('Y-m-d');
            }
            $i++;
            $nextPaymentDate = $day ?
                Carbon::parse($nextPaymentDate)->addDays($this->periodDurationByDay)
                :
                Carbon::parse($nextPaymentDate)->addMonths($this->periodDurationByMonth);
        }
    }

}

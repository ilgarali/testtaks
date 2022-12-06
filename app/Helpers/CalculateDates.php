<?php

namespace App\Helpers;

use Carbon\Carbon;

class CalculateDates
{
    private float $periodDurationByDay = 0;
    private float $periodDurationByMonth = 0;
    private array $dates = [];

    public function calculate(
        int $period_of_calculation_of_percentages, int $frequency_of_payment,
        string $date_of_issue, string $last_circulation_date): array
    {
        switch ($period_of_calculation_of_percentages){
            case 360:
                $this->periodDurationByDay = 12 / $frequency_of_payment * 30;
                break;
            case 364:
                $this->periodDurationByDay = 364 / $frequency_of_payment;
                break;
            case 365:
                $this->periodDurationByMonth = 12 / $frequency_of_payment;
                break;
        }

        if ($this->periodDurationByDay != 0) {
            $nextPaymentDate = Carbon::parse($date_of_issue)->addDays($this->periodDurationByDay);
            $this->calculateByDate($nextPaymentDate, $last_circulation_date, true);
        }
        if ($this->periodDurationByMonth != 0) {
            $nextPaymentDate = Carbon::parse($date_of_issue)->addMonths($this->periodDurationByMonth);

            $this->calculateByDate($nextPaymentDate, $last_circulation_date, false);
        }

        return $this->dates;
    }

    public function calculateByDate($nextPaymentDate, $last_circulation_date, $day = true)
    {
        $i = 0;
        while ($nextPaymentDate < $last_circulation_date){
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

<?php

namespace App\Services;

use App\Services\Interface\ReportInterface;
use Illuminate\Support\Facades\Auth;

class ReportService implements ReportInterface
{
    public function calculate($data)
    {
        $rateBalance =  $data['brokerRate'] - $data['drivenRate'];
        $rate_minus_percent = $rateBalance - (($rateBalance * floatval($data['percent'])) / 100);
        $result = ['rateBalance' => $rateBalance, 'rateMinusPercent' => $rate_minus_percent];
        return $result;
    }
}

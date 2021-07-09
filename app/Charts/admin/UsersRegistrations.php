<?php

namespace App\Charts\admin;

use App\Subscription;
use App\User;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class UsersRegistrations extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $users = User::selectRaw('year(created_at) year, month(created_at) month, monthname(created_at) monthname, day(created_at) dayname, DATE(created_at) label, count(*) data')
            ->where('created_at', '>', Carbon::now()->addMonths(-1))->groupBy('year', 'month', 'monthname', 'dayname', 'label')->orderBy('year')->orderBy('month')->orderBy('dayname')->get();
        $this->options([
            'maintainAspectRatio' => false,
            'cutoutPercentage' => 70,
            'caretPadding' => 10,
            'tooltips' => [
                'backgroundColor' => "rgb(255,255,255)",
                'bodyFontColor' => "#858796",
                'titleMarginBottom' => 10,
                'titleFontColor' => '#6e707e',
                'titleFontSize' => 14,
                'borderColor' => '#dddfeb',
                'borderWidth' => 1,
                'xPadding' => 15,
                'yPadding' => 15,
                'displayColors' => false,
                'intersect' => false,
            ],
        ]);

        $this->displayLegend(false);
        $this->labels($users->pluck('label'));
        $this->dataset('Nových registraci', 'line', $users->pluck('data'))->options([
            'lineTension' => 0.3,
            'borderWidth' => 3,
            'pointRadius' => 4,
            'pointBackgroundColor' => "rgba(19, 63, 116, 1)",
            'pointBorderColor' => "rgba(19, 63, 116, 1)",
            'pointHoverRadius' => 4,
            'pointHoverBackgroundColor' => "rgba(19, 63, 116, 1)",
            'pointHoverBorderColor' => "rgba(19, 63, 116, 1)",
            'pointHitRadius' => 10,
            'pointBorderWidth' => 2,
            'backgroundColor' => "rgba(37, 125, 231, 0.25)",
            'borderColor' => "rgba(37, 125, 231, 1)"
        ]);
    }
}

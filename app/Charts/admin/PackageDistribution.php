<?php

namespace App\Charts\admin;

use App\Package;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class PackageDistribution extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $packages = Package::all();
        $data = [];
        foreach ($packages as $package) {
            $data[] = $package->subscriptionsValid->count();
        }
                $borderColors = [
            "rgba(37, 125, 231, 1)",
            "rgba(126, 39, 39, 1)",
            "rgba(56, 126, 39, 1)",
            "rgba(90, 92, 105, 1)"
        ];
        $fillColors = [
            "rgba(37, 125, 231, 0.7)",
            "rgba(126, 39, 39, 0.7)",
            "rgba(56, 126, 39, 0.7)",
            "rgba(90, 92, 105, 0.7)"
        ];
        $this->minimalist(true);
        $this->displayLegend(true);
        $this->labels($packages->pluck('title'));
        $this->dataset('Balíčky', 'doughnut', $data)
            ->color($borderColors)
            ->backgroundcolor($fillColors);
    }
}

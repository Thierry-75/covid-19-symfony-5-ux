<?php

namespace App\Service;

class ChartJsService {

    public function chartRegionNouveau($chart, $label, $nellehospi, $nellerea) {
        $chart->setData([
            'labels' => array_reverse($label),
            'datasets' => [
                [
                    'label' => 'nelle hospi',
                    'backgroundColor' => 'rgb(22,154,242)',
                    'data' => array_reverse($nellehospi),
                ],
                [
                    'label' => 'nelle réa',
                    'backgroundColor' => 'rgb(249,247,91)',
                    'data' => array_reverse($nellerea),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($nellehospi) + min($nellehospi)]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartRegionAncien($chart, $label, $hospitalisation, $reanimation) {
        $chart->setData([
            'labels' => array_reverse($label),
            'datasets' => [
                [
                    'label' => 'hospitalisation',
                    'backgroundColor' => 'rgb(243,110,103)',
                    'data' => array_reverse($hospitalisation),
                ],
                [
                    'label' => 'réanimation',
                    'backgroundColor' => 'rgb(113,246,18)',
                    'data' => array_reverse($reanimation),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($hospitalisation) + 50]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartRegionFinal($chart, $label, $gueris, $deces) {
        $chart->setData([
            'labels' => array_reverse($label),
            'datasets' => [
                [
                    'label' => 'Décès',
                    'backgroundColor' => 'rgb(246,200,18)',
                    'data' => array_reverse($deces),
                ],
                [
                    'label' => 'Guéris',
                    'backgroundColor' => 'rgb(116,92,172)',
                    'data' => array_reverse($gueris),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($gueris) + min($gueris)]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartDepartementNouveau($chart, $label, $nellehospi, $nellerea) {
        $chart->setData([
            'labels' => array_reverse($label),
            'datasets' => [
                [
                    'label' => 'nelle hospi',
                    'backgroundColor' => 'rgb(22,154,242)',
                    'data' => array_reverse($nellehospi),
                ],
                [
                    'label' => 'nelle réa',
                    'backgroundColor' => 'rgb(249,247,91)',
                    'data' => array_reverse($nellerea),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($nellehospi) + min($nellehospi)]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartDepartementAncien($chart, $label, $hospitalisation, $reanimation) {
        $chart->setData([
            'labels' => array_reverse($label),
            'datasets' => [
                [
                    'label' => 'hospitalisation',
                    'backgroundColor' => 'rgb(243,110,103)',
                    'data' => array_reverse($hospitalisation),
                ],
                [
                    'label' => 'réanimation',
                    'backgroundColor' => 'rgb(113,246,18)',
                    'data' => array_reverse($reanimation),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($hospitalisation) + 50]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartDepartementFinal($chart, $label, $gueris, $deces) {
        $chart->setData([
            'labels' => array_reverse($label),
            'datasets' => [
                [
                    'label' => 'Décès',
                    'backgroundColor' => 'rgb(246,200,18)',
                    'data' => array_reverse($deces),
                ],
                [
                    'label' => 'Guéris',
                    'backgroundColor' => 'rgb(116,92,172)',
                    'data' => array_reverse($gueris),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($gueris) + min($gueris)]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartFrance($chart, $label, $hospitalisation, $reanimation, $deces, $gueris) {
        $chart->setData([
            'labels' => array_reverse($label),
            'datasets' => [
                [
                    'label' => 'hospi',
                    'backgroundColor' => 'rgb(249,21,40)',
                    'data' => array_reverse($hospitalisation),
                ],
                [
                    'label' => 'réa',
                    'backgroundColor' => 'rgb(230,249,21)',
                    'data' => array_reverse($reanimation),
                ],
                [
                    'label' => 'guéris',
                    'backgroundColor' => 'rgb(8,119,246)',
                    'data' => array_reverse($gueris),
                ],
                [
                    'label' => 'deces',
                    'backgroundColor' => 'rgb(21,249,135)',
                    'data' => array_reverse($deces),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($gueris) + 1]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartWorld($chart, $names, $cases, $deaths, $recovered, $active, $taux_mort) {
        $chart->setData([
            'labels' => ($names),
            'datasets' => [
                [
                    'label' => 'cas',
                    'backgroundColor' => 'rgb(230,243,144)',
                    'data' => ($cases),
                ],
                [
                    'label' => 'décès',
                    'backgroundColor' => 'rgb(207,57,12)',
                    'data' => ($deaths),
                ],
                [
                    'label' => 'guéris',
                    'backgroundColor' => 'rgb(144,230,243)',
                    'data' => ($recovered),
                ],
                [
                    'label' => 'contaminés',
                    'backgroundColor' => 'rgb(107,219,118)',
                    'data' => ($active),
                ],
                [
                    'label' => 'cas par million',
                    'backgroundColor' => 'orange',
                    'data' => ($taux_mort),
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($cases)]]
                ]
            ]
        ]);
        return $chart;
    }

    public function chartContinent($chart, $cases, $deaths, $recovered, $active, $taux_mort) {
        $chart->setData([
            'labels' => ' ',
            'datasets' => [
                [
                    'label' => 'cas',
                    'backgroundColor' => 'rgb(230,243,144)',
                    'data' => $cases,
                ],
                [
                    'label' => 'décès',
                    'backgroundColor' => 'rgb(207,57,12)',
                    'data' => $deaths,
                ],
                [
                    'label' => 'guéris',
                    'backgroundColor' => 'rgb(144,230,243)',
                    'data' => $recovered,
                ],
                [
                    'label' => 'contaminés',
                    'backgroundColor' => 'rgb(107,219,118)',
                    'data' => $active,
                ],
                [
                    'label' => 'décès / 1 million',
                    'backgroundColor' => 'orange',
                    'data' => $taux_mort,
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($cases)]]
                ]
            ]
        ]);
        return $chart;
    }

    // 0=>date, 1=>nom, 2=>cas, 3=>deces, 4=>gueris, 5=>contamine, 6=>hospitalise, 7=> casMillion, 8=>decesMillion
    public function chartPaysCompare($chart, $label, $cases, $deces, $gueris, $hospitalise, $casMillion) {
        $chart->setData([
            'labels' => $label,
            'datasets' => [
                [
                    'label' => 'cas',
                    'backgroundColor' => 'rgb(230,243,144)',
                    'data' => ($cases),
                ],
                [
                    'label' => 'décès',
                    'backgroundColor' =>  'rgb(207,57,12)',
                    'data' => ($deces),
                ],
                                [
                    'label' => 'guéris',
                    'backgroundColor' =>  'rgb(144,230,243)',
                    'data' => ($gueris),
                ],
                                [
                    'label' => 'hospitalisé',
                    'backgroundColor' => 'orange',
                    'data' => ($hospitalise),
                ],
                                [
                    'label' => 'cas / million',
                    'backgroundColor' => 'rgb(21,249,135)',
                    'data' => ($casMillion),
                ],

            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => ['position' => 'top']
                ],
                'yAxes' => [
                    ['ticks' => ['min' => 0, 'max' => max($cases)+1]]
                ]
            ]
        ]);
        return $chart;
    }

}

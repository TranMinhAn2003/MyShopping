<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $config = [
            'js' => [
                asset('js/plugins/flot/jquery.flot.js'),
                asset('s/plugins/flot/jquery.flot.tooltip.min.js'),
                asset('s/plugins/flot/jquery.flot.spline.js'),
                asset('s/plugins/flot/jquery.flot.resize.js'),
                asset('s/plugins/flot/jquery.flot.symbol.js'),
                asset('js/plugins/flot/curvedLines.js'),
                asset('js/plugins/peity/jquery.peity.min.js'),
                asset('s/plugins/flot/jquery.flot.pie.js'),
                asset('js/demo/peity-demo.js'),
                asset('js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js'),
                asset('js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'),
                asset('js/plugins/sparkline/jquery.sparkline.min.js'),
                asset('js/demo/sparkline-demo.js'),
                asset('js/plugins/chartJs/Chart.min.js')
            ]
        ];
        $template = 'dashboard.home.index';
        return view('dashboard.index', compact('template', 'config'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PackSizeCalculatorController extends Controller
{
    /**
     * Display simple form with widget-count input.
     * Submission results are displayed below the form on the same page.
     *
     * @param Request $request
     * @return View
     */
    public function calculator(Request $request): View
    {
        $request->validate([
            'widget-count' => 'numeric|gt:0',
        ]);

        $widgetCount = $request->input('widget-count');
        $order = [];

        if ($widgetCount !== null) {
            $order = app('PacksCalculatorService')
                ->calculateOrder($widgetCount)
                ->getOrder();
        }

        return view('calculator', [
            'widgetCount' => $widgetCount,
            'order' => $order,
        ]);
    }
}

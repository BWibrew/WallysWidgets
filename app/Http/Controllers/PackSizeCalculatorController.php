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
            'widget-count' => 'numeric',
        ]);

        return view('calculator', [
            'widgetCount' => $request->input('widget-count'),
        ]);
    }
}

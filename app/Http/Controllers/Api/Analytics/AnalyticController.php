<?php

namespace App\Http\Controllers\Api\Analytics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\AnalyticHelpers;

class AnalyticController extends Controller
{
    use AnalyticHelpers;

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // Validate type first.
        $validated = $this->validateRequest($request);

        if ($validated['result'] === 'failed'):
            return response()->json(
                $validated['message']
            , 400);
        endif;

        // Fetch + return analytic data.
        return response()->json(
            $this->calculateAnalytics($request->filter, $request->search)
        , 200);
    }
}

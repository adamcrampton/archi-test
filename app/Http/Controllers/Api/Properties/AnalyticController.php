<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Properties\Property;

class AnalyticController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Property $property)
    {
        try {
            $property->analytics()->attach($request->type,
                [
                    'value' => $request->value
                ]
            );

            return response()->json(
                $property->analytics
            , 201);

        } catch (\Throwable $th) {
            Log::debug('Error saving property: ' . $th->__toString());
            return response()->json(
                'Could not save property analytic'
            , 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property, $filter = null)
    {
        return response()->json(
            $property->analytics
        , 200);
    }
}

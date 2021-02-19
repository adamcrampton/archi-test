<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Properties\Property;

class AnalyticController extends Controller
{
    private $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Properties\Property $property
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Property $property)
    {
        if (is_null($request->type)):
            return response()->json(
                'type parameter missing or null'
            , 400);
        elseif (is_null($request->value)):
            return response()->json(
                'value parameter missing or null'
            , 400);
        endif;

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
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!is_null($request->type)):
            if (!in_array($request->type, [
                'suburb', 'state', 'country'
            ])):
                return response()->json(
                    'type value must be suburb, state, or country'
                , 400);
            elseif (is_null($request->filter)):
                return response()->json(
                    'filter value must be present and not null when specifying type'
                );
            endif;

            $property = $this->property->where([
                $request->type => $request->filter
            ])
            ->with(['analytics'])
            ->get();
        endif;

        return response()->json(
            $property->analytics
        , 200);
    }
}

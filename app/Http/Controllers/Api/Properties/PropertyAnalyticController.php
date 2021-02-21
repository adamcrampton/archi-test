<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Properties\Property;
use App\Models\Analytics\AnalyticType;

class PropertyAnalyticController extends Controller
{
    private $type;

    public function __construct(AnalyticType $type)
    {
        $this->type = $type;
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

        // Check analytic type is valid.
        $typeCheck = $this->type->whereIn('name', [
            $request->type
        ])->get();

        if ($typeCheck->count() === 0):
            return response()->json(
                'Could not locate specified type'
            , 422);
        endif;

        try {
            $property->analytics()->sync([$typeCheck->first()->id,
                [
                    'value' => $request->value
                ]
            ]);

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
    public function show(Request $request, Property $property)
    {
        return response()->json(
            $property->analytics
        , 200);
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Properties\Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
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

        // Check analytic type could be found.
        $analytic = $property->analytics->where('name', $request->type)->first();

        if (is_null($analytic)):
            return response()->json(
                'invalid analytic type specified'
            , 422);
        endif;

        try {
            $property->analytics()->sync([$analytic->id,
                [
                    'value' => $request->value
                ]
            ]);

            return response()->json(
                $property->analytics
            , 201);

        } catch (\Throwable $th) {
            Log::debug('Error updating property: ' . $th->__toString());
            return response()->json(
                'Could not update property analytic'
            , 500);
        }
    }
}

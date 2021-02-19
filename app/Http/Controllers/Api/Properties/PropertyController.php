<?php

namespace App\Http\Controllers\Api\Properties;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use App\Models\Properties\Property;

class PropertyController extends Controller
{
    private $property;

    public function __construct(Property $property)
    {
        $this->property = $property;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(
            $this->property->all()
        , 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $property = $this->property->create([
                'guid' => Str::uuid(),
                'suburb' => $request->suburb,
                'state' => $request->state,
                'country' => $request->country
            ]);

            return response()->json(
                $property
            , 201);
        } catch (\Throwable $th) {
            Log::debug('Error saving property: ' . $th->__toString());
            return response()->json(
                'Could not save property'
            , 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  Property $property
     * @return \Illuminate\Http\Response
     */
    public function show(Property $property)
    {
        return response()->json(
            $property
        , 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Property $property)
    {
        try {
            $property->update([
                'suburb' => $request->suburb,
                'state' => $request->state,
                'country' => $request->country
            ]);

            return response()->json(
                $property
            , 200);
        } catch (\Throwable $th) {
            Log::debug('Error updating property:' . $th->__toString());
            return response()->json(
                'Could not update property'
            , 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Property $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        try {
            $property->delete;

            return response()->json(
                null
            , 204);
        } catch (\Throwable $th) {
            Log::debug('Error deleting property:' . $th->__toString());
            return response()->json(
                'Could not delete property'
            , 500);
        }
    }
}

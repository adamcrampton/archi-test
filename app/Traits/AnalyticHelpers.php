<?php

namespace App\Traits;

use App\Models\Properties\Property;

trait AnalyticHelpers
{
    /**
     * Check request contains what we need for a valid query.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function validateRequest($request)
    {
        if (!is_null($request->filter)):
            if (!in_array($request->filter, [
                'suburb', 'state', 'country'
            ])):
               return [
                    'result' => 'failed',
                    'message' => 'Error: filter parameter must be suburb, state or country'
               ];
            elseif (!$request->has('search') || !$request->search):
                return [
                    'result' => 'failed',
                    'message' => 'Error: search parameter must be present and not null when filter parameter is used'
                ];
            endif;
        endif;

        return [
            'result' => 'success',
            'message' => 'request successfully validated'
        ];
    }

    /**
     * Calculate analytic data for supplied type.
     *
     * @param string
     * @return array
     */
    public function calculateAnalytics($filter = null, $search = null)
    {
        // Get raw data.
        $data = is_null($filter)
              ? Property::with(['analytics'])->get()
              : Property::where([$filter => $search])
                        ->with(['analytics'])
                        ->get();

        // Extract analytics and group into analytic types.
        $grouped = $data->map(function ($property) {
                    return $property->analytics;
                })
                ->flatten()
                ->groupBy('name');

        // Calculate:
        // - min value
        // - max value
        // - median value
        // - % properties with value
        // - % properties with no value
        $values = $grouped->map(function ($group, $key) {
            return $group->map(function($item) {
                return $item->pivot->value;
            });
        });

        // Return an array of calculations grouped into analytic types.
        return $values->map(function ($group) use ($data) {
            return [
                'min' => $group->min(),
                'max' => $group->max(),
                'median' => $group->median(),
                'with_values' => ($group->count() / $data->count()) * 100,
                'without_values' => 100 - (($group->count() / $data->count()) * 100)
            ];
        });
    }
}
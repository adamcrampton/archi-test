<?php

namespace App\Imports;

use App\Models\Properties\Property;
use Maatwebsite\Excel\Concerns\ToModel;

class FirstSheetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Property([
            //
        ]);
    }
}

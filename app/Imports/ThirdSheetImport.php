<?php

namespace App\Imports;

use App\Models\Properties\PropertyAnalytic;
use Maatwebsite\Excel\Concerns\ToModel;

class ThirdSheetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PropertyAnalytic([
            //
        ]);
    }
}

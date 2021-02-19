<?php

namespace App\Imports;

use App\Models\Analytics\AnalyticType;
use Maatwebsite\Excel\Concerns\ToModel;

class SecondSheetImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new AnalyticType([
            //
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Properties\PropertyAnalytic;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ThirdSheetImport implements ToModel, WithStartRow
{
    /**
     * @return integer
     */
    public function startRow(): int
    {
        return 2;
    }


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PropertyAnalytic([
            'property_id' => $row[0],
            'analytic_type_id' => $row[1],
            'value' => $row[2]
        ]);
    }
}

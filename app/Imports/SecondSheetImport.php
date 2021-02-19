<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

use App\Models\Analytics\AnalyticType;

class SecondSheetImport implements ToModel, WithStartRow, WithCalculatedFormulas
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
        return new AnalyticType([
            'name' => $row[1],
            'units' => $row[2],
            'is_numeric' => $row[3],
            'num_decimal_places' => $row[4]
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Properties\Property;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FirstSheetImport implements ToModel, WithStartRow
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
        return new Property([
            'guid' => Str::uuid(),
            'suburb' => $row[1],
            'state' => $row[2],
            'country' => $row[3]
        ]);
    }
}

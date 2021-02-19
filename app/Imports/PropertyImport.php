<?php

namespace App\Imports;

use App\Models\Properties\Property;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PropertyImport implements WithMultipleSheets
{
    /**
     * Process each sheet from imported XLSX file.
     *
     * @return array
     */
    public function sheets(): array
    {
        return [
            new FirstSheetImport(),
            new SecondSheetImport(),
            new ThirdSheetImport(),
        ];
    }
}

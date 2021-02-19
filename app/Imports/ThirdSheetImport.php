<?php

namespace App\Imports;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\OnEachRow;

use App\Models\Properties\Property;
use Maatwebsite\Excel\Row;

class ThirdSheetImport implements WithStartRow, OnEachRow
{
    /**
     * @return integer
     */
    public function startRow(): int
    {
        return 2;
    }

    public function onRow(Row $row)
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();

        $row = $row->toArray();
        $property = Property::find($row[0]);

        try {
            $property->analyticTypes()->attach(
                $row[1], [
                    'value' => $row[2]
                ]
            );

        } catch (\Throwable $th) {
            $output->writeln('Could not attach property to analytic type: ' . $th->getMessage());
            Log::debug('ThirdSheetImport: Error attaching property - ' . $th->__toString());
        }
    }
}

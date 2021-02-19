<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\PropertyImport;

class SeedPropertiesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new PropertyImport, '\xlsx\back_end_test_data.xlsx');
    }
}

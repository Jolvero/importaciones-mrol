<?php

namespace App\Exports;

use App\Kpi;
use Maatwebsite\Excel\Concerns\FromCollection;

class KpisExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kpi::all();
    }
}

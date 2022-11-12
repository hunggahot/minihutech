<?php

namespace App\Exports;

use App\Models\CategoryProductModels;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportProduct implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryProductModels::all();
    }
}

<?php

namespace App\Imports;

use App\Models\CategoryProductModels;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImports implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoryProductModels([
            'meta_keywords' => $row[0],
            'category_name' => $row[1],
            'category_des' => $row[2],
            'category_status' => $row[3],
        ]);
    }
}

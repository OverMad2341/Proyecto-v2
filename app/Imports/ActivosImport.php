<?php

namespace App\Imports;

use App\Models\Activo;
use Maatwebsite\Excel\Concerns\ToModel;

class ActivosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Activo([
            //
        ]);
    }
}

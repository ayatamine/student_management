<?php

namespace App\Imports;

use App\Matiere;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\Importable;

class MatieresImport implements ToModel,WithHeadingRow,WithCustomCsvSettings
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Matiere::create([
            'name'     => $row['name'],
            'cofficient'    => $row['cofficient'],
            'total' => $row['total'],
        ]);
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}

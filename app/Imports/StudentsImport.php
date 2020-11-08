<?php

namespace App\Imports;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class StudentsImport implements ToModel,WithHeadingRow,WithCustomCsvSettings
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return User::create([

            'name' => $row['name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            's_id' =>Str::random(5),
            'state'=>1,
            'email_verified_at'=>date('y-m-d')
        ]);
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}

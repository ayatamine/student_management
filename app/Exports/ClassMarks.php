<?php

namespace App\Exports;

use App\Classes;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClassMarks implements  FromQuery, WithMapping,WithCustomCsvSettings,WithHeadings
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public $class;
    public function __construct($class){
       $this->class = $class;
    }
    public function query()
    {
        return $this->class;
        //return Classes::query();
    }
    public function map($class): array
    {
        $heading = ["Number", "Secret_Id","Name"];
        $row=array();
        $matiere = array();
        foreach ($class->students as $i=>$student) {
            foreach ($class->matieres as $i=>$m) {
              $matiere[$i] = null;
            }

            $row[$i]=  array_merge([
                $i,
                $student->s_id,
                $student->name,
            ],$matiere);

        }
        return $row;


    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    public function headings(): array
    {
        return array_merge(["Number", "Secret_Id","Name"],$this->class->matieres->pluck('name')->toArray());
    }
    // public function collection()
    // {
    //     return Classes::all();
    // }
}

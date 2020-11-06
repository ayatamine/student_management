<?php

namespace App\Exports;

use App\Marks;
use App\Classes;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

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
              $matiere[$i] = Marks::whereStudentId($student->id)->whereMatiereId($m->id)->first()->mark;
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
        $modules = $this->class->matieres->pluck('name')->map(function($item){
            return  $item.',';
        })->toArray();
        return array_merge(["Number,", "Secret_Id,","Name,"],$modules);
    }
    // public function collection()
    // {
    //     return Classes::all();
    // }
}

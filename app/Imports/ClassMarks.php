<?php

namespace App\Imports;

use App\User;
use App\Marks;
use App\Classes;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ClassMarks implements ToModel,WithHeadingRow,WithCustomCsvSettings
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    use Importable;
    public $class;
    public function __construct($class){
       $this->class = $class;
    }
    public function model(array $row)
    {
       // dd($row);
        $student  = User::whereSId($row['secret_id'])->first();
        $marks = Marks::whereStudentId($student->id)->get();
        foreach ($marks as $mark) {
           $mark->delete();
        }

        $new_marks=array();
        foreach ($this->class->matieres as $m) {
          $new_marks['student_id'] = $student->id;
          $new_marks['matiere_id'] = $m->id;
          $new_marks['mark'] = $row[$m->name];
          Marks::create($new_marks);
        }
        return $student;
    }
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
}

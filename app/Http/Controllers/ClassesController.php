<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Matiere;
use App\Marks;
use Session;
class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $classes = Classes::latest()->get();
         return view('admin.classes.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'string|required',
            'studing_day_number'=>'required'
        ]);
        Classes::create($request->all());
        Session::flash('success','تم ‘ضافة القسم بنجاح');
         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
            //
            $class_details = Classes::with('students')->with('matieres')->findorfail($id);
            $matieres = Matiere::whereNotIn('id',$class_details->matieres->pluck('id'))->get();
            return view('admin.classes.details',compact('class_details','matieres'));

    }
    //attach an existing matiere to the class
    public function attachMatiere(Request $request){
        $this->validate($request,[
            'matiere_id'=>'required',
            'class_id'=>'required'
        ]);
        $class = Classes::findorfail($request->class_id);
        $class->matieres()->attach($request->matiere_id);

        //add marks to all matieres in the class
        $this->addMarksToAllStudent($class,$request->matiere_id);

        Session::flash('success','تم إضافة المادة بنجاح');
        return back();
    }
    public function detachMatiere($class_id,$matiere){

        $class = Classes::findorfail($class_id);
        $class->matieres()->detach($matiere);
        //remove marks from student account
        $this->removeMarksToAllStudent($class,$matiere);
        Session::flash('success','تم إزالة المادة بنجاح');
        return back();
    }
    ////add a new matiere to a class
    public function createAddMatiere(Request $request){
         $this->validate($request,[
             'matiere'=>'string|required',
             'class_id'=>'required',
         ]);
         $class = Classes::findorfail($request->class_id);
         $matiere = Matiere::create([
             'name'=>$request->matiere,
             'cofficient'=>$request->cofficient,
             'total'=>$request->total,
         ]);
         $class->matieres()->attach($matiere->id);
         //add marks of this matiere to all students of this class
         $this->addMarksToAllStudent($class,$matiere->id);
         Session::flash('success','تم إضافة المادة بنجاح');
         return back();
    }
    public function addMarksToAllStudent($class,$matiere_id){
        $new_marks=array();
        foreach ($class->students as $student) {
          $new_marks['student_id'] = $student->id;
          $new_marks['matiere_id'] = $matiere_id;
          $new_marks['mark'] = 0;
          Marks::create($new_marks);
        }
    }
    public function removeMarksToAllStudent($class,$matiere_id){

        foreach ($class->students as $student) {

            $mark  = Marks::whereStudentId($student->id)->whereMatiereId($matiere_id)->first();
            $mark->delete();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Classes::findorfail($id);

        $class->matieres()->detach($class->matieres->pluck('id'));
        $class->delete();
        //dd($class->matieres);
        Session::flash('success','تم حدف القسم بنجاح');
        return back();

    }
}

<?php

namespace App\Http\Controllers;
use App\Notifications\StudentAccountUnlocked;
use Illuminate\Http\Request;
use App\Classes;
use App\User;
use App\Marks;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Imports\StudentsImport;
use App\Imports\ClassMarks as ClassMarksImport;
use App\Exports\ClassMarks;
use Excel;
class AdminSingleController extends Controller
{
    public function _construct(){
      $this->middleware('auth:admin');
      $this->middleware('role:supervisor');
    }
    public function updateSiteSettings(Request $request){
        //dd($request);
        $this->validate($request,[
           'name'=>'required',
        ]);
        $name = $request->name;
        $email = $request->email | '';



        $logo=$request->logo;
        if($logo){
            $fich=time().$logo->getClientOriginalName();
            $logo->move(public_path('img/'),$fich);
        }else{
            $fich=$settings->logo;
        }

         $settings->site_name = $name;
         $settings->site_email = $email;
         $settings->logo = $fich;
         $settings->save();
         Session::flash('success','تم تغيير الإعدادات بنجاح');
         return redirect()->back();
  }
  public function updateAccount(Request $request){
    //dd($request);
    $this->validate($request,[
      'name'=>'required',
      'email'=>'required',
   ]);

   $admin = auth('admin')->user();
   $admin->name = $request->name;
   $admin->email = $request->email;
   $admin->password = $request->password ? Hash::make($request->password) : $admin->password;
   $admin->save();
    Session::flash('success','تم تعديل الحساب بنجاح');
    return redirect()->back();
  }
  public function updateStudent($id,Request $request){
    $request->validate([
      'name'=>'required',
      'email'=>'required',
    ]);
    $student = User::findorfail($id);
    $student->name = $request->name;
    $student->email = $request->email;
    $student->class_id = $request->class_id;
    $student->state = $request->state;
    $student->save();
    return response()->json([
      'student'=>$student,
      'class'=>$student->class,
      'message'=>'تم تحديث حساب الطالب بنجاح'
    ]);
  }
  public function deleteStudent($id){
    $student = User::findorfail($id);
    $student->delete();
    return response()->json([
      'student_id'=>$student->id,
      'message'=>'تم حدف حساب الطالب بنجاح'
    ]);
  }
  public function all_students(){

    $classes = Classes::latest()->get();
    $all_students = User::latest()->get();
    return view('admin.all_students',compact('all_students','classes'));
  }
  public function new_students(){

    $classes = Classes::latest()->get();
    $new_students = User::whereClassId(null)->latest()->get();
    return view('admin.new_students',compact('new_students','classes'));
  }
  ////activate student account
  public function activateAccount($student_id){
      $student = User::findorfail($student_id);
      $student->state = 1;$student->save();
      try {
        $student->notify(new StudentAccountUnlocked($student));
      } catch (\Throwable $th) {
          throw $th;
      }
      Session::flash('success','تم تفعيل حساب الطالب بنجاح');
      return back();
  }
  //attach a student to a class
  public function addToClass(Request $request){
    $this->validate($request,[
      'student_id'=>'required',
      'class_id'=>'required'
    ]);
    ///get the class first
    $class = Classes::findorfail($request->class_id);
    //test if the student account is active or not
    $student = User::findorfail($request->student_id);
    if($student->state == 0){
      Session::flash('warning','يرجى تفعيل حساب الطالب قبل ادراج القسم');
    }
    else{
       $class->students()->save($student);
       Session::flash('success',' تم ادراج الطالب في القسم '.$class->name);
    }
    //add marks to all matieres in the class
        $new_marks=array();
        foreach ($class->matieres as $m) {
          $new_marks['student_id'] = $student->id;
          $new_marks['matiere_id'] = $m->id;
          $new_marks['mark'] = 0;
          Marks::create($new_marks);
        }
    return back();
  }
  public function addAbsence(Request $request){
    $this->validate($request,[
      'student_id'=>'required',
      'absence_number'=>'required'
    ]);

    $student = User::findorfail($request->student_id);
    $student->absence_number = $request->absence_number;
    $student->save();
    Session::flash('success','تم تسجيل الغياب بنجاح');
    return back();
  }
  //get marks of a student by module
  public function Marks($student_id){

    $student = User::with('class')->with('marks')->findorfail($student_id);
    //$matieres = $student->class->matieres;
    return view('admin.classes.marks',compact('student'));
  }
  public function updateMarks($student_id,Request $request){

        $marks = Marks::whereStudentId($student_id)->get();
        foreach ($marks as $mark) {
           $mark->delete();
        }
        $new_marks=array();
        $i = 0;
        foreach ($request->matieres_ids as $mid) {
          $new_marks['student_id'] = $student_id;
          $new_marks['matiere_id'] = $mid;
          $new_marks['mark'] = $request->matieres_marks[$i];
          $i++;
          Marks::create($new_marks);
        }
        Session::flash('success','تم تعديل النقاط بنجاح');
        return back();

  }
  public function importStudents(Request $request){
    (new StudentsImport)->import($request->file('file'), null, \Maatwebsite\Excel\Excel::CSV);
    Session::flash('success','تم رفع الطلبة بنجاح');
    return back();
  }
  public function exportClassMarks($class_id){
    $class = Classes::with('students')->with('matieres')->findorfail($class_id);
    return (new ClassMarks($class))->download('class_marks.csv', \Maatwebsite\Excel\Excel::CSV,[
      'Content-Type' => 'text/csv',
    ]);

  }
  public function importClassMarks(Request $request){
    //dd($request->all());
    $class = Classes::findorfail($request->class_id);
    (new ClassMarksImport($class))->import($request->file('file'), null, \Maatwebsite\Excel\Excel::CSV);
    Session::flash('success','تم رفع النقاط بنجاح');
    return back();

  }
}

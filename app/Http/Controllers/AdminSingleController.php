<?php

namespace App\Http\Controllers;
use App\Notifications\StudentAccountUnlocked;
use Illuminate\Http\Request;
use App\Classes;
use App\Setting;
use App\User;
use App\Marks;
use Session;
use Illuminate\Support\Facades\Hash;

class AdminSingleController extends Controller
{
    public function updateSiteSettings(Request $request){
        //dd($request);
        $this->validate($request,[
           'name'=>'required',
        ]);
        $name = $request->name;
        $email = $request->email | '';

        $settings = Setting::find(1);

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
  public function students(){
    $settings = Setting::find(1);
    $normal_students = User::latest()->get();
    return view('admin.students',compact('settings','normal_students'));
  }
  public function new_students(){
    $settings = Setting::find(1);
    $classes = Classes::latest()->get();
    $new_students = User::whereClassId(null)->latest()->get();
    return view('admin.new_students',compact('settings','new_students','classes'));
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
    $settings = Setting::find(1);
    $student = User::with('class')->with('marks')->findorfail($student_id);
    //$matieres = $student->class->matieres;
    return view('admin.classes.marks',compact('student','settings'));
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
}

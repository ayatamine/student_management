<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\MatieresImport;
use App\Matiere;
use Session;
use App\Marks;
use Excel;
class MatiereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        $matiere = Matiere::findorfail($id);
        $matiere->delete();
        $this->removeMarksToAllStudent($matiere->id);
        Session::flash('success','تم حدف المادة بنجاح');
        return back();
    }
    public function removeMarksToAllStudent($matiere_id){

          $marks  = Marks::whereMatiereId($matiere_id)->get();
          foreach ($marks as $mark) {
            $mark->delete();
          }

    }
    public function importMatieres(Request $request){
        (new MatieresImport)->import($request->file('file'), null, \Maatwebsite\Excel\Excel::CSV);
        Session::flash('success','تم رفع المواد بنجاح يمكنك ادراجها الان في القسم');
        return back();
    }
}

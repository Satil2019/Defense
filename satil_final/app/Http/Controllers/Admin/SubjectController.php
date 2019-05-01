<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Response;
use App\Section;
use App\Subject;
class SubjectController extends Controller
{
    public function test(){
        $data=Subject::all();
        return view('admin.Subject.subject',['data'=>$data]);

    }
    public function saveData(Request $request){
        //
        $this->validate($request,[
            'subjectCode'=>'required',
            'subjectName'=>'required',
        ]);
        $Subject=new Subject();
        $Subject->subjectCode=$request->subjectCode;
        $Subject->subjectName=$request->subjectName;
        $Subject->save();
        return redirect('admin/subject')->with('message','Subject created successfully');
    }
    public function edit($id=null){
        $data=Subject::findOrFail($id);
        return view('admin.Subject.editSubject',['data'=>$data]);
    }
    public function delete($id=null){
        Subject::where('id',$id)->delete();
        return redirect('admin/subject')->with('message','Subject deleted successfully');
    }
    public function UpdateData(Request $request){
        $this->validate($request,[
            'subjectCode'=>'required',
            'subjectName'=>'required',
        ]);
        $data=Subject::findOrFail($request->id);
        $data->subjectCode=$request->subjectCode;
        $data->subjectName=$request->subjectName;
        $data->update();
        return redirect('admin/subject')->with('message','Subject updated successfully');
    }
}

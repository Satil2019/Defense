<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use DB;
use Validator;
use Response;
use App\User;
use App\Section_student;
use App\Section_teacher;
use App\Subject;
class SectionController extends Controller
{
    public function test(){
        $data=Section::all();
        return view('admin.section.section',['data'=>$data]);
    }
    public function saveData(Request $request){
        $this->validate($request,[
            'name'=>'required',
        ]);
        $Section=new Section();
        $Section->name=$request->name;
        $Section->save();
        return redirect('admin/section')->with('message','Section created successfully');
    }
    public function Edit($id=null){
        $Section=Section::findOrFail($id);
        return $Section;
    }
    public function update(Request $req=null){
        $data = Section::find($req->id);
        $data->name = $req->name;
        $data->save();

        return response()->json($data);
    }
    public function destroy(Request $req=null){
        Section::find($req->id)->delete();
        return response()->json();
    }

    //section wise student managedy on one section
    //here 30 student stu o
    public function student(){
        $students=User::where('user_type','=','student')->get();
        $sections=Section::all();
        $subjects=Subject::all();
        $datas = DB::table('section_students')
            ->join('users', 'users.id', '=', 'section_students.student_id')
            ->join('sections', 'section_students.section_id', '=', 'sections.id')
            ->join('subjects', 'section_students.subject_id', '=', 'subjects.id')
            ->select('section_students.id as section_students_id','users.id as user_id',
                'users.name as user_name','sections.id as section_id',
                'sections.name as section_name','subjects.subjectName as subjectName')
            ->where('users.user_type', '=','student')
            ->get();

        return view('admin/SectionBaseStudent/SectionBaseStudent',
            ['sections'=>$sections,'students'=>$students,'datas'=>$datas,'subjects'=>$subjects]);
    }

    // section wise Teacher manage
    public function teacher(){
        $teachers=User::where('user_type','=','teacher')->get();
        $sections=Section::all();
        $subjects=Subject::all();
        $datas = DB::table('section_teachers')
            ->join('users', 'users.id', '=', 'section_teachers.teacher_id')
            ->join('sections', 'section_teachers.section_id', '=', 'sections.id')
            ->join('subjects', 'section_teachers.subject_id', '=', 'subjects.id')
            ->select('section_teachers.id as section_teachers_id','users.id as user_id','users.name as user_name',
                'sections.id as section_id','sections.name as section_name','subjects.subjectName as subjectName')
            ->where('users.user_type', '=','teacher')
            ->get();
        return view('admin/SectionBaseTeacher/SectionBaseTeacher',
            ['sections'=>$sections,'teachers'=>$teachers,'datas'=>$datas,'subjects'=>$subjects]);
    }
    public function addStudentOnSection(Request $request){
        $this->validate($request,[
            'student_id'=>'required',
            'section_id'=>'required',
            'student_id'=>'required',
        ]);
        $section_id=$request->section_id;
        $student_id=$request->student_id;
        $subject_id=$request->subject_id;
        $Section_teacher=Section_student::where('subject_id','=',$subject_id)
            ->where('section_id','=',$section_id)
            ->where('student_id','=',$student_id)->first();
        if ($Section_teacher){
            return redirect('/admin/section/student')->with('error','Already entered .....');
        }
        $Section_student=new Section_student();
        $Section_student->section_id=$request->section_id;
        $Section_student->student_id=$request->student_id;
        $Section_student->subject_id=$request->subject_id;
        $sectinoData=Section::findOrFail($section_id);
        $Section_student->sectionName=$sectinoData->name;
        $SubjectData=Subject::findOrFail($subject_id);
        $Section_student->subjectName=$SubjectData->subjectName;
        $Section_student->save();
        return redirect('admin/section/student')->with('message','Student added to section');
    }

    public function deleteStudentOnSection($id=null){
        Section_student::find($id)->delete();
        return redirect('admin/section/student')->with('message','section deleted successfully');
    }
    public function EditStudentOnSection($id=null){
        $data= Section_student::find($id);
        $students=User::where('user_type','=','student')->get();
        $sections=Section::all();
        $subjects=Subject::all();
        return view('admin/SectionBaseStudent/edit',['sections'=>$sections,'students'=>$students,
            'data'=>$data,'subjects'=>$subjects]);
    }
    public function UpdateStudentOnSection(Request $req){
        $id= $req->id;
        $data=Section_student::find($id);
        $data->section_id=$req->section_id;
        $data->student_id=$req->student_id;
        $data->subject_id=$req->subject_id;
        $data->update();
        return redirect('admin/section/student')->with('message','section updated successfully');

    }
    public function addTeacherOnSection(Request $request){

        $this->validate($request,[
            'subject_id'=>'required',
            'section_id'=>'required',
            'teacher_id'=>'required',
        ]);
        $subject_id=$request->subject_id;
        $section_id=$request->section_id;
        $teacher_id=$request->teacher_id;
        $Section_teacher=Section_teacher::where('subject_id','=',$subject_id)
                        ->where('section_id','=',$section_id)
                        ->where('teacher_id','=',$teacher_id)->first();
        if ($Section_teacher){
          return redirect('/admin/section/teacher')->with('error','Already entered .....');
        }
        $Section_student=new Section_teacher();
        $Section_student->subject_id=$subject_id;
        $Section_student->section_id=$section_id;
        $sectinoData=Section::findOrFail($section_id);
        $Section_student->sectionName=$sectinoData->name;
        $SubjectData=Subject::findOrFail($subject_id);
        $Section_student->subjectName=$SubjectData->subjectName;
        $Section_student->teacher_id=$teacher_id;
        $Section_student->save();
        return redirect('admin/section/teacher')->with('message','Teacher added to section');
    }
    public function deleteTeacherOnSection($id=null){
        Section_teacher::find($id)->delete();
        return redirect('admin/section/teacher')->with('message','section deleted successfully');
    }
    public function EditTeacherOnSection($id=null){
        $data= Section_teacher::findOrFail($id);
        $students=User::where('user_type','=','teacher')->get();
        $sections=Section::all();
        $subjects=Subject::all();
        return view('admin/SectionBaseTeacher/edit',['sections'=>$sections,'students'=>$students,
            'data'=>$data,'subjects'=>$subjects]);
    }
    public function UpdateTeacherOnSection(Request $req){
        $id= $req->id;
        $data=Section_teacher::findOrFail($id);
        $data->section_id=$req->section_id;
        $data->subject_id=$req->subject_id;
        $data->teacher_id=$req->teacher_id;
        $data->update();
        return redirect('admin/section/teacher')->with('message','section updated successfully');

    }
}

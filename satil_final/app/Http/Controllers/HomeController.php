<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use DB;
use Validator;
use Response;
use Session;
use Auth;
use App\Attendence;
use App\Attendence_Details;
use App\Subject;
use App\Section_teacher;
use App\Section_student;
class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type=auth::user()->user_type;
        if ($type=='teacher'){
            $datas=Section_teacher::where('teacher_id','=',auth::user()->id)->get();
        }else{
            $datas=Section_student::where('student_id','=',auth::user()->id)->get();
        }
        return view('FrontEnd.Home.home',['datas'=>$datas]);
    }

    public function SubjectNameTeacher(Request $request){
        $data=Section_teacher::select('subjectName','subject_id')->where('section_id',$request->id)
                            ->where('teacher_id',auth::user()->id)->take(100)->get();
        return response()->json($data);
        
    }
    public function SubjectNameStudent(Request $request){
        $data=Section_student::select('subjectName','subject_id')->where('section_id',$request->id)
                            ->where('student_id',auth::user()->id)->take(100)->get();
        return response()->json($data);
    }

    public function datatesting($id){
        $data=DB::table('section_teachers')
            ->join('subjects', 'section_teachers.subject_id', '=', 'subjects.id')
            ->select('subjects.id as subjects_id','subjects.subjectName as subjectName')
            ->where('section_teachers.subject_id', '=',$id)
            ->where('section_teachers.teacher_id', '=',auth::user()->id)
            ->get();
        return $data;
    }
    public function test(Request $request){
        $this->validate($request,[
            'section_id'=>'required',
            'subject_id'=>'required',
        ]);
        $sectionId=$request->section_id;
        $subject_id=$request->subject_id;

        session()->put('sectionId',$sectionId);
        $attendenceSectionWise=Attendence::where('section_id',$sectionId)->whereDate('created_at',date('Y-m-d'))
                                            ->where('subject_id',$subject_id)->where('teacher_id',auth::user()->id)->get();

        $datas = DB::table('section_students')
            ->join('users', 'users.id', '=', 'section_students.student_id')
            ->join('sections', 'section_students.section_id', '=', 'sections.id')
            ->join('subjects', 'section_students.subject_id', '=', 'subjects.id')
            ->select('section_students.id as section_students_id','users.id as user_id','users.name as user_name',
                'sections.id as section_id','sections.name as section_name','subjects.id as subjects_id','subjects.subjectName as subjectName')
            ->where('users.user_type', '=','student')
            ->where('sections.id', '=',$sectionId)
            ->where('subjects.id', '=',$subject_id)
            ->get();
        session()->put('datas',$datas);
        if(!empty($attendenceSectionWise['0'])){
            $uniqueCode=$attendenceSectionWise['0']->secretKey;
        }else{
            //unique code
            $letter="AbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ";
            $number="0123456789";
            $uniqueCode=substr(str_shuffle($letter.$number), 0, 7);
            $Attendence=new Attendence();
            $Attendence->teacher_id=auth::user()->id;
            $Attendence->secretKey=$uniqueCode;
            $Attendence->section_id=$sectionId;
            $Attendence->subject_id=$subject_id;
            $Attendence->save();
        }
        session()->put('uniqueCode',$uniqueCode);
        return view('FrontEnd.Attendance.TeacherAttendance',['datas'=>$datas,'uniqueCode'=>$uniqueCode]);
    }


    public function getMethodOfTest(){
        $sectionId=Session::get('sectionId');
        $datas=Session::get('datas');
        $uniqueCode=session()->get('uniqueCode');
        return view('FrontEnd.Attendance.TeacherAttendance',['datas'=>$datas,'uniqueCode'=>$uniqueCode]);
    }

    public function takeAttendance(Request $request){
        $datas=Session::get('datas');
        $ss=array();
        $datas=session()->get('datas');
        foreach ($datas as $data){
            $uniqueCode=session()->get('uniqueCode');
            $attendenceSectionWise=Attendence_Details::where('Taken_',$uniqueCode)->where('student_id',$data->user_id)->first();
            if(is_null($attendenceSectionWise)){
                $Attendence_Details=new Attendence_Details();
                $name=$data->user_name;
                $Attendence_Details->Taken_=$uniqueCode;
                $Attendence_Details->student_id=$data->user_id;
                if (!is_null($request->$name)){
                    $Attendence_Details->is_present=1;
                }
                $Attendence_Details->Taken_=$uniqueCode;
                $Attendence_Details->save();
            }
        }
        return view('FrontEnd.welcome');
    }
    public function MatchToSectionAndSecret(Request $request){
        $request->validate([
            'section_id' => 'required',
            'subject_id' => 'required',
            'secret' => 'required',
        ]);
        $section_id=$request->section_id;
        $subject_id=$request->subject_id;
        $secret=$request->secret;
        $attendence=Attendence::where('section_id',$section_id)->whereDate('created_at',date('Y-m-d'))
                                ->where('subject_id',$subject_id)->where('secretKey',$secret)->first();
        //return '$section_id :'.$section_id. '$subject_id :'.$subject_id.' $secret: '.$secret;
        if(!is_null($attendence)){
            //Within two minutes student can give attendance
            $TimeDate=explode(",",$attendence->created_at);
            $stringDateTime=$TimeDate['0'];
            $splitdateTime= str_split($stringDateTime,10);
            $AttendenceTime=$splitdateTime['1'];
            $AttendenceDate=$splitdateTime['0'];
            //current date time calculation
            $current=date('Y-m-d H:i:s');
            $current=str_split($current,10);
            $currentDate=$current['0'];
            $currentTime=$current['1'];
            if($AttendenceDate==$currentDate){
                //split Attendence Time
                 $Atime=explode(":",$AttendenceTime);
                 $Ahour=$Atime['0'];
                 $Aminute=$Atime['1'];
                 //split Current Time
                 $Ctime=explode(":",$currentTime);
                 $Chour=$Ctime['0'];
                 $Cminute=$Ctime['1'];
                 if ($Ahour==$Chour){
                    if($Aminute+3>$Cminute){
                        session()->put('secret',$secret);
                        return view('FrontEnd.Attendance.TeacherAttendance');

                    }else{
                        return redirect()->back()->with('message','Mismatch with key');
                    }
                 }else{
                     return redirect()->back()->with('message','Mismatch with key');
                 }

            }

        }
        return redirect()->back()->with('message','Mismatch with key');

    }
    public function dateTime(){

    }
    public function StudentGiveAttendence(Request $request){
        $request->validate([
            'attendence' => 'required',
        ]);
        $secret=Session::get('secret');
        $attendence=Attendence_Details::where('Taken_',$secret)->where('student_id',auth::user()->id)->first();
        if (is_null($attendence)){
            $Attendence_Details=new Attendence_Details();
            $Attendence_Details->Taken_=$secret;
            $Attendence_Details->student_id=auth::user()->id;
            $Attendence_Details->is_present=1;
            $Attendence_Details->save();
            return view('FrontEnd.welcome');
        }

        return redirect('/home')->with('message','Attendance not taken');
    }
}

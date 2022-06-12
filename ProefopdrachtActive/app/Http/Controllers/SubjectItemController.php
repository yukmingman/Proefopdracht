<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubjectItemController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $subjects = Subject::all();
        Log::info(json_encode($subjects->all()));
        return view("welcome")->with("students", $students)->with("subjects", $subjects);
    }

    public function saveItem(Request $request)
    {
        if($request->newgrade >= 1 && $request->newgrade<= 10){
            Log::info(json_encode($request->all()));
            DB::table("student_subject")->insert(["subject_id" => $request->subject, "student_id" => $request->student, "grade" => $request->newgrade]);
        }

        return redirect("/");
    }

    public function deleteItem($id)
    {
        DB::table("student_subject")->where("id","=",$id)->delete();
        return redirect("/");
    }

    public function modifyItem($id, Request $request)
    {
        if($request->newgrade >= 1 && $request->newgrade<= 10){
            DB::table("student_subject")->where("id","=",$id)->update(["grade" => $request->newgrade]);
            return redirect("/");
        }
    }
}

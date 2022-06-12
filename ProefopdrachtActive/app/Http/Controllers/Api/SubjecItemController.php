<?php

namespace App\Http\Controllers\Api;

use App\Models\Subject;
use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjecItemController extends BaseController
{
    public function index()
    {
        $students = Student::all();

        $gradelist = array();
        foreach ($students as $student) {
            foreach ($student->subjects as $subject) {
                $gradelist[] = array("student" => $student->name, "subject" => $subject->name, "grade" => $subject->pivot->grade);
            }
        }

        return $this->sendResponse($gradelist, 'Students retrieved successfully.');
    }

    public function addGrade(Request $request)
    {

        $input = $request->all();

        $validator = Validator::make($input, [
            'student_id' => 'required',
            'subject_id' => 'required',
            'grade' => 'required|integer|between:1,10'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
        DB::table("student_subject")->insert(["subject_id" => $input["subject_id"], "student_id" => $input["student_id"], "grade" => $input["grade"]]);
        return $this->sendResponse($input, 'Add grade success');
    }

    public function deleteGrade(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => [
                'required',
                Rule::exists('student_subject')
                    ->where('id', $input["id"]),
            ],
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::table("student_subject")->where("id", "=", $input["id"])->delete();
        return $this->sendResponse(201, 'Grade deleted');
    }

    public function modifyGrade(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'id' => [
                'required',
                Rule::exists('student_subject')
                    ->where('id', $input["id"]),
            ],
            'grade' => 'required|integer|between:1,10'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        DB::table("student_subject")->where("id", "=", $input["id"])->update(["grade" => $input["grade"]]);
        return $this->sendResponse($input, 'modify grade success');
    }
}

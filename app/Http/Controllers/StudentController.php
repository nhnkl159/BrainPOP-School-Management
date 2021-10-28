<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\Student;
use App\Models\Period;
use App\Models\Teacher;
use App\Http\Resources\Student as ResourcesStudent;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

use Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->tokenCan('students:index')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        //If user adds period parameter
        if ($request->filled('teacher_id')) {
            //Checks if given id is a number and if exists in teachers database.
            $request->validate([
                'teacher_id' => 'integer|exists:App\Models\Teacher,id',
            ]);

            //Need to save as variable for query.
            $teacherId = $request->input('teacher_id');
            
            //We need to make special query using exist relationships, using Student periods relationship and then teacher to recieve all students.
            $teacher_students = Student::whereHas('periods.teacher', function($teacherQueryBuilder) use ($teacherId) {
                $teacherQueryBuilder->where('id', $teacherId);
            })->get();

            return ResourcesStudent::collection($teacher_students);
        }
        if ($request->filled('period_id')) {
            //Checks if given id is a number and if exists in periods database.
            $request->validate([
                'period_id' => 'integer|exists:App\Models\Period,id',
            ]);
            $period_students = Period::find($request->input('period_id'))->students;
            return ResourcesStudent::collection($period_students);
        }

        $students = Student::all();
        return ResourcesStudent::collection($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'grade' => $request->grade
        ]);

        return new ResourcesStudent($student);
    }

    /**
     * Display the specified resource.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        if (!Auth::user()->tokenCan('students:show')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        return new ResourcesStudent($student);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  Student  $student
     * @param  UpdateStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Student $student, UpdateStudentRequest $request)
    {
        if (!Auth::user()->tokenCan('students:update')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        $student->update([
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'grade' => $request->grade
        ]);

        return new ResourcesStudent($student);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        if (!Auth::user()->tokenCan('students:destroy')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        $student->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

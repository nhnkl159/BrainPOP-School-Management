<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Login as student
     * 
     * @param  Illuminate\Http\Request  $request
     */
    public function student(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check if student exists
        $student = Student::where('username', $request->input('username'))->first();

        //Check password
        if(!$student || !Hash::check($request->input('password'), $student->password))
        {
            return response()->json([
                'message' => 'Username or password is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }
    
        //We set permissions for student token
        $permissions = [
            'students:index',
            'students:show',
        ];

        $token = $student->createToken('studentToken', $permissions)->plainTextToken;

        $response = [
            'student' => $student,
            'token' => $token
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    
    /**
     * Login as teacher
     * 
     * @param  Illuminate\Http\Request  $request
     */
    public function teacher(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        //Check if teacher exists
        $teacher = Teacher::where('username', $request->input('username'))->first();

        //Check password
        if(!$teacher || !Hash::check($request->input('password'), $teacher->password))
        {
            return response()->json([
                'message' => 'Username or password is incorrect'
            ], Response::HTTP_UNAUTHORIZED);
        }

        //We set permissions for teacher token
        $permissions = [
            'students:index',
            'students:store',
            'students:show',
            'students:update',
            'students:destroy',
            'teachers:index',
            'teachers:store',
            'teachers:show',
            'teachers:update',
            'teachers:destroy',
            'periods:index',
            'periods:store',
            'periods:show',
            'periods:update',
            'periods:destroy',
        ];

        $token = $teacher->createToken('teacherToken', $permissions)->plainTextToken;

        $response = [
            'teacher' => $teacher,
            'token' => $token
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}

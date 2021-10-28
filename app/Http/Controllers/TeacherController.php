<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;

use App\Models\Teacher;
use App\Http\Resources\Teacher as ResourcesTeacher;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;

use Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->tokenCan('teachers:index')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        $teachers = Teacher::all();
        return ResourcesTeacher::collection($teachers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ResourcesTeacher  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $teacher = Teacher::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'email' => $request->email
        ]);

        return new ResourcesTeacher($teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        if (!Auth::user()->tokenCan('teachers:show')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        return new ResourcesTeacher($teacher);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Teacher  $teacher
     * @param  StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Teacher $teacher, UpdateTeacherRequest $request)
    {
        if (!Auth::user()->tokenCan('teachers:update')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        $teacher->update([
            'password' => Hash::make($request->password),
            'full_name' => $request->full_name,
            'email' => $request->email
        ]);

        return new ResourcesTeacher($teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        if (!Auth::user()->tokenCan('teachers:destroy')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }
        $teacher->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Period;
use App\Models\Teacher;
use App\Http\Resources\Period as ResourcesPeriod;

use App\Http\Requests\StorePeriodRequest;
use App\Http\Requests\UpdatePeriodRequest;

use Auth;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!Auth::user()->tokenCan('periods:index')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        //If user adds teacher_id parameter
        if ($request->filled('teacher_id')) {
            //Checks if given id is a number and if exists in teachers database.
            $request->validate([
                'teacher_id' => 'integer|exists:App\Models\Teacher,id',
            ]);
            $teacher_periods = Teacher::find($request->input('teacher_id'))->periods;
            return ResourcesPeriod::collection($teacher_periods);
        }
        
        //else return all periods
        $periods = Period::with('teacher')->get();
        return ResourcesPeriod::collection($periods);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePeriodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePeriodRequest $request)
    {
        if (!Auth::user()->tokenCan('periods:store')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        $period = Period::create([
            'teacher_id' => $request->teacher_id,
            'name' => $request->name
        ]);

        return new ResourcesPeriod($period);
    }

    /**
     * Display the specified resource.
     *
     * @param  Period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(Period $period)
    {
        if (!Auth::user()->tokenCan('periods:show')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        return new ResourcesPeriod($period);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Period  $period
     * @param  UpdatePeriodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Period $period, UpdatePeriodRequest $request)
    {
        if (!Auth::user()->tokenCan('periods:update')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        $period->update([
            'teacher_id' => $request->teacher_id,
            'name' => $request->name
        ]);

        return new ResourcesPeriod($period);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(Period $period)
    {
        if (!Auth::user()->tokenCan('periods:destroy')) {
            return response()->json(['message' => 'No Permissions.'], Response::HTTP_FORBIDDEN);
        }

        $period->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

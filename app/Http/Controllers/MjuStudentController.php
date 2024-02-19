<?php

namespace App\Http\Controllers;

use App\Models\MjuStudent;
use Illuminate\Http\Request;

class MjuStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = MjuStudent::all();

        return $students;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_code' => 'required|string|max:15',
            'first_name' => 'required|string|max:50',
            'first_name_en' => 'required|string|max:50',
            'major_id' => 'required|exists:majors,major_id',
            'id_card' => 'required||digits:13',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        MjuStudent::create($validated);

        return response()->json(['message' => 'Student created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(request $request, MjuStudent $mjuStudent)
    {
        //$students = MjuStudent::with('major')->get();
        $student_code = $request->mju;
        $mjuStudent = MjuStudent::all()->find($student_code);
        //$mjuStudent = $mjuStudent::with('major')->find($student_code);
        //->where('student_code','=',$student_code)

        return response()->json(
            [
                'message' => 'Student get successfully',
                'get data by TATAR',
                'data' => $mjuStudent
            ],
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MjuStudent $mjuStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MjuStudent $mjuStudent)
    {
        // 1) ตรวจสอบความถูกต้องของข้อมูล validate $request
        $validated = $request->validate([
            'student_code' => 'required|string|max:15',
            'first_name' => 'required|string|max:50',
            'first_name_en' => 'required|string|max:50',
            'major_id' => 'required|exists:majors,major_id',
            'id_card' => 'required|digits:13',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        // 2) หาข้อมูลนักศึกษาที่ต้องการอัปเดต
        $mjuStudent = MjuStudent::find($request->student_code);

        // 3) ตรวจสอบว่าพบข้อมูลนักศึกษาหรือไม่
        if (!$mjuStudent) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        // 4) อัปเดตข้อมูลและบันทึกลงฐานข้อมูล
        $mjuStudent->update($validated);

        // 5) ส่งคืนการตอบสนอง
        return response()->json(['message' => 'Student update successfully', 'data' => $mjuStudent], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, MjuStudent $mjuStudent)
    {
        $mjuStudent = MjuStudent::find($request->student_code);
        if ($mjuStudent) {
        $mjuStudent->delete();
        return response()->json(['message' => 'Student deleted successfully'], 200);
        } else{
            return response()->json(['message' => 'Student not found'], 404);
        }


    }


}



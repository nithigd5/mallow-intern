<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        return view('students', [
            'students' => Student::with('marks')->get(),
            'marks' => Mark::all()
        ]);
    }

    public function create(Request $request)
    {

        $profile = $request->profile->store('images');

        $studentId = DB::table('students')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'address' => $request->address,
            'gender' => $request->gender == 'secret' ? null : $request->gender,
            'profile' => $profile,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('marks')->insert([
            'mark1' => $request->mark1 ,
            'mark2' => $request->mark2 ,
            'mark3' => $request->mark3 ,
            'mark4' => $request->mark4 ,
            'mark5' => $request->mark5 ,
            'student_id' => $studentId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('students');
    }

    public function get(Student $student)
    {
        return $student;
    }
}

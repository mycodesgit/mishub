<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Student;
use App\Models\Voucher;
use App\Models\Enrolled;

class StudentlistController extends Controller
{
    public function studentRead() 
    {
        return view('campuswifi.stud.list');
    }

    public function getstudentRead() 
    {
        $data = Student::leftJoin('voucher', 'students.vc_id', '=', 'voucher.id')
                        ->leftJoin('studentslist', 'students.stud_id', '=', 'studentslist.stud_id')
                        ->select('students.*', 'students.id as s_id', 'voucher.voucher_code', 'studentslist.*')
                        ->get();
        return response()->json(['data' => $data]);
    }


    public function studentEdit($id) 
    {
        $student = Student::findOrFail($id);

        return view('campuswifi.stud.edit', compact('student'));
    }

    public function studentUpdate(Request $request) 
    {
        
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        try {

            $student = Student::findOrFail($request->input('id'));
            $student->update([
                'password' => Hash::make($request->input('password')),
            ]);
            return response()->json(['success' => true, 'message' => 'Password Updated Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => 'Failed to update Password!'], 404);
        }
    }
}

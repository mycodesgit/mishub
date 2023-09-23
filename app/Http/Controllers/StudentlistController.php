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
    // public function studentRead() {
    //     $student = Student::join('voucher', 'students.vc_id', '=', 'voucher.id')
    //                         ->join('studentslist', 'students.stud_id', '=', 'studentslist.stud_id')
    //                         ->select('students.*', 'students.id as s_id', 'voucher.voucher_code', 'studentslist.*')
    //                         ->get();
    //     return view('campuswifi.stud.list', compact('student'));
    // }

    public function studentRead() {
        $student = Student::leftJoin('voucher', 'students.vc_id', '=', 'voucher.id')
                        ->leftJoin('studentslist', 'students.stud_id', '=', 'studentslist.stud_id')
                        ->select('students.*', 'students.id as s_id', 'voucher.voucher_code', 'studentslist.*')
                        ->get();
        return view('campuswifi.stud.list', compact('student'));
    }


    public function studentEdit($id) {
        $student = Student::findOrFail($id);

        return view('campuswifi.stud.edit', compact('student'));
    }

    public function studentUpdate(Request $request) {
        $student = Student::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'password' => 'required',
        ]);

        try {

            $student = Student::findOrFail($request->input('id'));
            $student->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('studentEdit', ['id' => $student->id])->with('success', 'Password Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Password!');
        }
    }
}

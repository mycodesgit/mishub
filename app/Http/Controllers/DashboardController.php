<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Voucher;
use App\Models\Student;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(){
        $stud = Student::count();
        $voucher1 = Voucher::where('status', '=', '1')->count();
        $voucher2 = Voucher::where('status', '=', '0')->count();
        $user = User::count();

        $currentYear = now()->year;

        $studentJanuaryCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 1)->count();
        $studentFebruaryCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 2)->count();
        $studentMarchCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 3)->count();
        $studentAprilCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 4)->count();
        $studentMayCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 5)->count();
        $studentJuneCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 6)->count();
        $studentJulyCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 7)->count();
        $studentAugustCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 8)->count();
        $studentSeptemberCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 9)->count();
        $studentOctoberCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 10)->count();
        $studentNovemberCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 11)->count();
        $studentDecemberCount = Student::whereYear('created_at', '=', $currentYear)->whereMonth('created_at', '=', 12)->count();
        return view("home.dashboard", compact('stud',
                                            'voucher1', 
                                            'voucher2', 
                                            'user', 
                                            'studentJanuaryCount',
                                            'studentFebruaryCount',
                                            'studentMarchCount',
                                            'studentAprilCount',
                                            'studentMayCount',
                                            'studentJuneCount',
                                            'studentJulyCount',
                                            'studentAugustCount',
                                            'studentSeptemberCount',
                                            'studentOctoberCount',
                                            'studentNovemberCount',
                                            'studentDecemberCount',
                                        ));
    }
    public function destroy() {
        Auth::logout();

        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}

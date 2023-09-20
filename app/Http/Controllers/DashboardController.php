<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Voucher;
use App\Models\Student;

class DashboardController extends Controller
{
    public function dashboard(){
        $stud = Student::count();
        $voucher1 = Voucher::where('status', '=', '1')->count();
        $voucher2 = Voucher::where('status', '=', '0')->count();
        return view("home.dashboard", compact('stud', 'voucher1', 'voucher2'));
    }
    public function destroy() {
        Auth::logout();

        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}

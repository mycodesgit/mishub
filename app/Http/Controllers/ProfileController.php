<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Office;
use App\Models\Campus;

class ProfileController extends Controller
{
    public function profileRead() {
        $user = Auth::user(); 
        $office = Office::all();
        $campus = Campus::all();

        return view("profile.info", compact('office', 'campus'));
    }

    public function profileUpdate(Request $request) {
        try {
            $request->validate([
                'lname' => 'required|string|max:255',
                'fname' => 'required|string|max:255',
                'mname' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
                'role' => 'required',
                'gender' => 'required',
            ]);

            Auth::user()->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'username' => $request->input('username'),
                'role' => $request->input('role'),
                'gender' => $request->input('gender'),
            ]);

            return redirect()->route('profileRead')->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            return redirect()->route('profileRead')->with('error', 'Failed to update profile');
        }
    }

    public function profilePassUpdate(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|string|min:5,' . Auth::id(),
            ]);

            Auth::user()->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('profileRead')->with('success', 'Password updated successfully');
        } catch (Exception $e) {
            return redirect()->route('profileRead')->with('error', 'Failed to update Password');
        }
    }
}

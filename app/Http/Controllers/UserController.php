<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Office;
use App\Models\Campus;

class UserController extends Controller
{
    public function userRead() {
        $office = Office::all();
        $campus = Campus::all();
        $user = User::join('offices', 'users.off_id', '=', 'offices.id')
                ->select('users.*', 'offices.office_abbr')
                ->get();

        return view("users.ulist", compact('user', 'office', 'campus'));
    }

    public function userCreate(Request $request) {

        if ($request->isMethod('post')) {
            $request->validate([
                'lname' => 'required',
                'fname' => 'required',
                'mname' => 'required',
                'username' => 'required|string|min:5|unique:users,username',
                'password' => 'required|string|min:5',
                'off_id' => 'required',
                'role' => 'required',
                'gender' => 'required',
                'campus_id' => 'required',
            ]);

            $userName = $request->input('username'); 
            $existingUser = User::where('username', $userName)->first();

            if ($existingUser) {
                return redirect()->route('userRead')->with('error', 'User already exists!');
            }

            try {
                User::create([
                    'lname' => $request->input('lname'),
                    'fname' => $request->input('fname'),
                    'mname' => $request->input('mname'),
                    'username' => $userName,
                    'password' => Hash::make($request->input('password')),
                    'off_id' => $request->input('off_id'),
                    'role' => $request->input('role'),
                    'gender' => $request->input('gender'),
                    'campus_id' => $request->input('campus_id'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('userRead')->with('success', 'User stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('userRead')->with('error', 'Failed to store user!');
            }
        }
    }

    public function userEdit($id) {
        $campus = Campus::all();
        $office = Office::all();
        $selectedUser = User::find($id);

        $selectedOfficeId = $selectedUser->off_id;
        $selectedCampusId = $selectedUser->campus_id;

        return view('users.editUser', compact('campus', 'office', 'selectedUser', 'selectedOfficeId', 'selectedCampusId'));
    }

    public function userUpdate(Request $request) {
        $user = User::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'off_id' => 'required',
            'role' => 'required',
            'gender' => 'required',
            'campus_id' => 'required',
        ]);

        try {
            $userName = $request->input('username');
            $existingUser = User::where('username', $userName)->where('id', '!=', $request->input('id'))->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'Username already exists for another user!');
            }

            $user = User::findOrFail($request->input('id'));
            $user->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'username' => $userName,
                'off_id' => $request->input('off_id'),
                'role' => $request->input('role'),
                'gender' => $request->input('gender'),
                'campus_id' => $request->input('campus_id'),
            ]);

            return redirect()->route('userEdit', ['id' => $user->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update User!');
        }
    }

    public function userUpdatePassword(Request $request) {
        $user = User::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'password' => 'required|string|min:5',
        ]);

        try {
            $user = User::findOrFail($request->input('id'));
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);

            return redirect()->route('userEdit', ['id' => $user->id])->with('success', 'Password Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update User Password!');
        }
    }

    public function userDelete($id){
        $user = User::find($id);
        $user->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }

}

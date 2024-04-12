<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Daily;
use App\Models\Option;

class AccomplishmentController extends Controller
{
    public function dailyRead() {
        $userId = Auth::id();
        $option = Option::all();
        $daily = Daily::join('users', 'accomplishment.user_id', '=', 'users.id')
                    ->select('accomplishment.*', 'accomplishment.id  as accom_id')
                    ->where('accomplishment.user_id', '=',  $userId)
                    ->orderBy('accomplishment.created_at', 'ASC')
                    ->get();
        return view('accomplishment.dlist', compact('daily', 'option'));
    }

    public function dailyCreate(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'task' => 'required',
                'no_accom' => 'required',
                'user_id' => 'required',
                'created_at' => 'required',
            ]);

            try {
                Daily::create([
                    'task' => $request->input('task'),
                    'no_accom' => $request->input('no_accom'),
                    'user_id' => $request->input('user_id'),
                    'remember_token' => Str::random(60),
                    'created_at' => $request->input('created_at'),
                ]);

                return redirect()->route('dailyRead')->with('success', 'Accomplishment stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('dailyRead')->with('error', 'Failed to store Accomplishment!');
            }
        }
    }
    
    public function dailyEdit($id) {
        $option = Option::all();
        $daily = Daily::findOrFail($id);

        $selectedTask = $daily->task;

        return view('accomplishment.editDaily', compact('option', 'daily', 'selectedTask'));
    }

    public function dailyUpdate(Request $request) {
        $daily = Daily::find($request->id);
        
        $request->validate([
            'id' => 'required',
            'task' => 'required',
            'no_accom' => 'required',
        ]);

        try {

            $daily = Daily::findOrFail($request->input('id'));
            $daily->update([
                'task' => $request->input('task'),
                'no_accom' => $request->input('no_accom'),

            ]);

            return redirect()->route('dailyEdit', ['id' => $daily->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Accomplishment!');
        }
    }

    public function dailyDelete($id){
        $daily = Daily::find($id);
        $daily->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }
}

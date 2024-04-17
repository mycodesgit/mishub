<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Daily;
use App\Models\Option;

class AccomplishmentController extends Controller
{
    public function dailyRead() 
    {
        $userId = Auth::id();
        $option = Option::all();
        
        return view('accomplishment.dlist', compact('option'));
    }

    public function getdailyRead() 
    {
        $userId = Auth::id();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $data = Daily::join('users', 'accomplishment.user_id', '=', 'users.id')
                    ->leftJoin('option_task', 'accomplishment.task', '=', 'option_task.option_name')
                    ->select('accomplishment.*', 'accomplishment.id  as accom_id', 'option_task.*', 'accomplishment.created_at as acrt')
                    ->where('accomplishment.user_id', '=',  $userId)
                    ->where(DB::raw('MONTH(accomplishment.acrt)'), '=', $currentMonth)
                    ->where(DB::raw('YEAR(accomplishment.acrt)'), '=', $currentYear)
                    ->orderBy('accomplishment.acrt', 'ASC')
                    ->get();

        return response()->json(['data' => $data]);
    }

    public function dailyCreate(Request $request) 
    {
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
                return response()->json(['success' => true, 'message' => 'Accomplishment stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Accomplishment!'], 404);
            }
        }
    }
    
    public function dailyEdit($id) 
    {
        $option = Option::all();
        $daily = Daily::findOrFail($id);

        $selectedTask = $daily->task;

        return view('accomplishment.editDaily', compact('option', 'daily', 'selectedTask'));
    }

    public function dailyUpdate(Request $request) 
    {
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
            return response()->json(['success' => true, 'message' => 'Update successfully'], 200);
            // return redirect()->route('dailyEdit', ['id' => $daily->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            // return redirect()->back()->with('error', 'Failed to update Accomplishment!');
            return response()->json(['error' => true, 'message' => 'Failed to update Accomplishment!'], 404);
        }
    }

    public function dailyDelete($id)
    {
        $daily = Daily::find($id);
        $daily->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }
}

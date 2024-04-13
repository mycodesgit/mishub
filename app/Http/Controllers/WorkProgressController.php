<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\GanttChart;
use App\Models\User;

class WorkProgressController extends Controller
{
    public function workprogRead() 
    {
        $userId = Auth::id();
        $users = User::all();
        
        return view('gantt.wrkp', compact('users'));
    }

    public function getworkprogRead() 
    {
        $userId = Auth::id();
        $data = GanttChart::select('task', 'start_date', 'end_date', 'duration', 'user_id', 'percent_completed', 'status', 'id')->get();

        $formattedData = [];
        
        foreach ($data as $row) {
            $userIds = explode(',', $row->user_id);
            $fnames = [];
            foreach ($userIds as $userId) {
                $user = User::find($userId);
                if ($user) {
                    $fnames[] = '<span class="badge badge-secondary" style="font-size: 9pt">' . $user->fname .'</span>';
                }
            }
            $formattedData[] = [
                'task' => $row->task,
                'start_date' => $row->start_date,
                'end_date' => $row->end_date,
                'duration' => $row->duration,
                'fnames' => implode(', ', $fnames),
                'percent_completed' => $row->percent_completed,
                'status' => $row->status,
                'id' => $row->id
            ];
        }
        return response()->json(['data' => $formattedData]);
    }

    public function workprogCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'task' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'duration' => 'required',
                'user_id' => 'required',
            ]);

            try {
                GanttChart::create([
                    'task' => $request->input('task'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                    'duration' => $request->input('duration'),
                    'user_id' => implode(',', $request->input('user_id')),
                    'remember_token' => Str::random(60),
                ]);
                return response()->json(['success' => true, 'message' => 'Project stored successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'message' => 'Failed to store Project!'], 404);
            }
        }
    }
}

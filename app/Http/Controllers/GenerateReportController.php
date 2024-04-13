<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

use App\Models\User;
use App\Models\Daily;

class GenerateReportController extends Controller
{
    public function genoptionRead() 
    {
        return view('reports.optionReports');
    }
    
    public function generateReports(Request $request) 
    {
        $userId = Auth::id();
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $group = $request->has('group') ? 'on' : 'off';

        if ($group == 'on') {
            $accom = Daily::where('user_id', $userId)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->groupBy('task')
                ->select('task', DB::raw('GROUP_CONCAT(no_accom SEPARATOR "<br>") as grouped_no_accom'))
                ->get();

        } else {
            $accom = Daily::where('user_id', $userId)
                ->whereBetween('created_at', [$start_date, $end_date])
                ->get();
        }

        $data = [
            'accom' => $accom,
            'group' => $group,

        ];

        $pdf = PDF::loadView('reports.genReports', $data)->setPaper('Letter', 'portrait');
        return $pdf->stream();
    }
}

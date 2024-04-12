<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\MemoFile;

class MemoFileController extends Controller
{
    public function docufileRead() {
        return view('memofile.memoList');
    }
}

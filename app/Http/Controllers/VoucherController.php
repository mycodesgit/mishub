<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\Voucher;

class VoucherController extends Controller
{
    public function voucherRead() 
    {
        $voucher1 = Voucher::where('status', '=', '1')->where('semester', '=', '1')->where('schlyear', '=', '2025-2026')->get();
        $voucher2 = Voucher::where('status', '=', '0')->where('semester', '=', '1')->where('schlyear', '=', '2025-2026')->get();
        return view('campuswifi.voucher.vlist', compact('voucher1', 'voucher2'));
    }

    public function process(Request $request) 
    {
        if ($request->hasFile('csv_file')) {
            $uploadedFile = $request->file('csv_file');
            
            $csvData = file_get_contents($uploadedFile->getPathname());
            $csvArray = array_map('str_getcsv', explode("\n", $csvData));

            $lastId = Voucher::max('id');
            $nextId = $lastId + 1;

            foreach ($csvArray as $row) {
                $voucherCode = $row[0] ?? null;

                if ($voucherCode) {
                    $existingRecord = Voucher::where('voucher_code', $voucherCode)->first();

                    if (!$existingRecord) {
                        Voucher::create([
                            'id' => $nextId,
                            'voucher_code' => $voucherCode
                        ]);
                        $nextId++;
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'CSV file uploaded and processed successfully!');
    }
}
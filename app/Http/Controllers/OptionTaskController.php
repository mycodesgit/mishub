<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Option;

class OptionTaskController extends Controller
{
    public function optiontaskRead() 
    {
        $option = Option::all();
        return view('optionTask.olist', compact('option'));
    }

    public function optiontaskCreate(Request $request) 
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'option_name' => 'required',
            ]);

            $optionName = $request->input('option_name'); 
            $existingOption = Option::where('option_name', $optionName)->first();

            if ($existingOption) {
                return redirect()->route('optiontaskRead')->with('error', 'User already exists!');
            }

            try {
                Option::create([
                    'option_name' => $request->input('option_name'),
                    'remember_token' => Str::random(60),
                ]);

                return redirect()->route('optiontaskRead')->with('success', 'Option stored successfully!');
            } catch (\Exception $e) {
                return redirect()->route('optiontaskRead')->with('error', 'Failed to store Option!');
            }
        }
    }

    public function optiontaskEdit($id) 
    {
        $option = Option::all();

        $selectedOptionTask = Option::findOrFail($id);

        return view('optionTask.olist', compact('option', 'selectedOptionTask'));
    }

    public function optiontaskUpdate(Request $request) 
    {
        $request->validate([
            'id' => 'required',
            'option_name' => 'required',
        ]);

        try {
            $optionName = $request->input('option_name');
            $existingOption = Option::where('option_name', $optionName)->where('id', '!=', $request->input('id'))->first();

            if ($existingOption) {
                return redirect()->back()->with('error', 'Option Task already exists!');
            }

            $option = Option::findOrFail($request->input('id'));
            $option->update([
                'option_name' => $optionName,
            ]);

            return redirect()->route('optiontaskEdit', ['id' => $option->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Option Task!');
        }
    }

    public function optiontaskDelete($id)
    {
        $option = Option::find($id);
        $option->delete();

        return response()->json([
            'status'=>200,
            'message'=>'Deleted Successfully',
        ]);
    }
}

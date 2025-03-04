<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterMatchController extends Controller
{
    public function index()
    {
        return view('character_match');
    }

    public function calculate(Request $request)
    {
        $input1 = strtoupper($request->input('input1'));
        $input2 = strtoupper($request->input('input2'));

        $uniqueChars1 = str_split($input1);
        $uniqueChars2 = array_unique(str_split($input2));

        $matchCount = 0;
        $string = '';
        foreach ($uniqueChars1 as $char1) {
            foreach ($uniqueChars2 as $char2) {
                if ($char2 == $char1) {
                    $string .= $char2.' ';
                    $matchCount++;
                }
            }
        }
        $totalUniqueChars = count($uniqueChars1);
        $percentage = $totalUniqueChars > 0 ? ($matchCount / $totalUniqueChars) * 100 : 0;
        $percentage = round($percentage, 2);

        return redirect()->back()->withInput()->with(compact('percentage', 'input1', 'input2'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\BibleNewProgram;
use App\Models\BibleProgram;
use App\Models\Program;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function linkShow(Request $request, $programType, $categoryId, $programId)
    {
        switch ($programType) {
            case 0:
                //節目
                $program = Program::with('category')
                    ->find($programId);
                break;
            case 1:
                //新約
                $program = BibleNewProgram::with('category')
                    ->find($programId);
                break;
            case 2:
                //舊約
                $program = BibleProgram::with('category')
                    ->find($programId);
                break;
        };

        return view('share.link_show')->with([
                'programType' => $programType,
                'categoryId'  => $categoryId,
                'program'     => $program->toArray()
            ]

        );
    }

    public function show(Request $request, $programType, $categoryId, $programId)
    {
        switch ($programType) {
            case 0:
                //節目
                $program = Program::with('category')
                    ->find($programId);
                break;
            case 1:
                //新約
                $program = BibleNewProgram::with('category')
                    ->find($programId);
                break;
            case 2:
                //舊約
                $program = BibleProgram::with('category')
                    ->find($programId);
                break;
        };

        return view('share.show')->with([
                'programType' => $programType,
                'categoryId'  => $categoryId,
                'program'     => $program->toArray()
            ]

        );
    }
}

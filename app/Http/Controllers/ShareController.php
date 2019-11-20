<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Models\News;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function show($id)
    {
        $program = Program::find($id);
//        dump($program->toArray());
        return view('share.show')->with('program', $program->toArray());
    }
}

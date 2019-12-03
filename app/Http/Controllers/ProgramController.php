<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\ProgramsBibleCollection;
use App\Http\Resources\ProgramsCollection;
use App\Models\BibleCategory;
use App\Models\BibleNewCategory;
use App\Models\BibleNewProgram;
use App\Models\BibleProgram;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use wapmorgan\Mp3Info\Mp3Info;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('programs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('programs.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function parser()
    {
        ini_set('memory_limit', '2048M');
        ignore_user_abort(true);
        set_time_limit(1200);

        //        $fileName = 'http://media.feearadio.net/downloads/program/BH/bh-191108.mp3';
        //        $contents = file_get_contents($fileName);
        //        Storage::disk('local')->put('public/bh-8787.mp3', $contents);
        //        dump(1);

        $fileNamea = storage_path('app/public/bh-7878.mp3');
        $fileName  = 'http://media.feearadio.net/downloads/program/BH/bh-191108.mp3';
        $result    = file_put_contents($fileNamea, fopen($fileName, 'r'));
        dump($result);
        dump(1);
        //        $fileNameb = storage_path('app/public/bh-191110.mp3');
        //        $audio     = new Mp3Info($fileNameb, true);
        //        dump($audio);
        //        // or omit 2nd argument to increase parsing speed
        //        $audio = new Mp3Info($fileNameb);//快
        //        dump($audio);
    }

    public function programListApi(Request $request)
    {
        $input    = $request->only(['programType', 'programID', 'page']);
        $id       = $input['programID'];
        $type     = $input['programType'];
        $page     = $request->get('page', null);
        switch ($type){
            case 0:
                break;
            case 1:
            case 2:
                $id = str_replace('n', '', $id);
                $id = str_replace('o', '', $id);
                break;
        }
        switch ($type) {
            case 0:
                //節目
                if (is_null($page)) {
                    $programs = Program::where('categories', $id)
                        ->get();
                    ProgramsBibleCollection::wrap('list');

                    return new ProgramsBibleCollection($programs);
                } else {
                    $programs = Program::where('categories', $id)
                        ->paginate(15);
                    ProgramsCollection::wrap('list');

                    return new ProgramsCollection($programs);
                }
            case 1:
                //新約
                if (is_null($page)) {
                    $programs = BibleNewProgram::where('categories', $id)
                        ->get();
                    ProgramsBibleCollection::wrap('list');

                    return new ProgramsBibleCollection($programs);
                } else {
                    $programs = BibleNewProgram::where('categories', $id)
                        ->paginate(15);
                    ProgramsCollection::wrap('list');

                    return new ProgramsCollection($programs);
                }
            case 2:
                //舊約
                if (is_null($page)) {
                    $programs = BibleProgram::where('categories', $id)
                        ->get();
                    ProgramsBibleCollection::wrap('list');

                    return new ProgramsBibleCollection($programs);
                } else {
                    $programs = BibleProgram::where('categories', $id)
                        ->paginate(15);
                    ProgramsCollection::wrap('list');

                    return new ProgramsCollection($programs);
                }
        };
    }

    public function programApi(Request $request)
    {
        $input    = $request->only(['programType']);
        $type     = $input['programType'];
        $programs = [];
        switch ($type) {
            case 0:
                //節目
                $categories = Category::where('status', 1)->orderBy('sort')
                    ->get();
                foreach ($categories as $row) {
                    $program = Program::with('category')
                        ->where('categories', $row->id)
                        ->where('start_date', '<', Carbon::now())
                        ->where('end_date', '>', Carbon::now())
                        ->orderBy('start_date', 'desc')
                        ->first();
                    if (! is_null($program)) {
                        $programs[] = $program;
                    }
                }
                break;
            case 1:
                //新約
                $categories = BibleNewCategory::orderBy('sort')
                    ->get();
                foreach ($categories as $row) {
                    $program = BibleNewProgram::with('category')
                        ->where('categories', $row->id)
                        ->first();
                    if (! is_null($program)) {
                        $programs[] = $program;
                    }
                }
                break;
            case 2:
                //舊約
                $categories = BibleCategory::orderBy('sort')
                    ->get();
                foreach ($categories as $row) {
                    $program = BibleProgram::with('category')
                        ->where('categories', $row->id)
                        ->first();
                    if (! is_null($program)) {
                        $programs[] = $program;
                    }
                }
                break;
        };
        CategoriesCollection::wrap('list');

        return new CategoriesCollection(collect($programs));
    }

}

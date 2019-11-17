<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesCollection;
use App\Http\Resources\ProgramsCollection;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        return view('programs.edit');
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
        //        $fileNamea = storage_path('app/public/bh-191110.mp3');
        //        $fileName = 'http://media.feearadio.net/downloads/program/BH/bh-191108.mp3';
        //        $result = file_put_contents($fileNamea, fopen($fileName, 'r'));
        //        dd($result);
        $fileNameb = storage_path('app/public/bh-191110.mp3');
        $audio     = new Mp3Info($fileNameb, true);
        dump($audio);
        // or omit 2nd argument to increase parsing speed
        $audio = new Mp3Info($fileNameb);
        dump($audio);
    }

    public function programListApi(Request $request)
    {
        $input    = $request->only(['programID', 'page']);
        $id       = $input['programID'];
        $programs = Program::where('categories', $id)
            ->paginate(15);
        ProgramsCollection::wrap('list');

        return new ProgramsCollection($programs);
    }

    public function programApi(Request $request)
    {
        $input = $request->only(['programType']);
        $type  = $input['programType'];
        $programs = [];
        switch ($type) {
            case 0:
                //節目
                $categories = Category::orderBy('sort')->get();
                foreach ($categories as $row) {
                    $program = Program::with('category')->where('categories', $row->id)
                        ->where('start_date', '<', Carbon::now())
                        ->where('end_date', '>', Carbon::now())
                        ->orderBy('start_date', 'desc')
                        ->first();
                    if (!is_null($program)) {
                        $programs[] = $program;
                    }
                }
                break;
            case 1:
                //新約
                $programs = [];
                break;
            case 2:
                //舊約
                $programs = [];
                break;
        };
        CategoriesCollection::wrap('list');

        return new CategoriesCollection(collect($programs));
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category as CategoryResource;
use App\Models\BibleCategory;
use App\Models\BibleNewCategory;
use App\Models\BibleNewProgram;
use App\Models\BibleProgram;
use App\Models\Category;
use App\Models\Program;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('categories.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function programDescriptionApi(Request $request)
    {
        $input = $request->only(['programID', 'programType']);
        $id = $input['programID'];
        $type = $input['programType'];
        $category = Category::find($id);
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
                $program = Program::find($id);
                $category = Category::find($program->categories);
                break;
            case 1:
                //新約
                $program = BibleNewProgram::find($id);
                $category = BibleNewCategory::find($program->categories);
                break;
            case 2:
                //舊約
                $program = BibleProgram::find($id);
                $category = BibleCategory::find($program->categories);
                break;
        };
        CategoryResource::withoutWrapping();

        return new CategoryResource($category);
    }
}

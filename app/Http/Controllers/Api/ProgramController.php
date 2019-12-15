<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Program\UpdateRequest;
use App\Http\Requests\Program\DestoryRequest;
use App\Http\Requests\Program\EditRequest;
use App\Models\Category;
use App\Services\ProgramService;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    private $programService;

    //@todo cron job 音源0 fixed
    //@todo 更新mp3 url 音源要reset 0, 讓crone重抓長度

    public function __construct(ProgramService $programService)
    {
        $this->programService = $programService;
    }

    public function index(Request $request)
    {
        $perPage    = $request->get('perPage', null);
        $category   = $request->get('category', null);
        $sort = $request->get('sort', null);
        $column = $request->get('column', null);
        $categories = Category::all();
        $programs   = $this->programService->programPaginate($perPage, $category, $column, $sort);
        $programs->appends($request->query())
            ->links();
        $result               = [];
        $result['programs']   = $programs;
        $result['categories'] = $categories;

        return response()->json($result);
    }

    public function store(StoreRequest $request)
    {
        $message = [
            'categories.required' => '節目名稱為必填',
            'title.max'           => '單集節目名稱限制30字',
            'title.required'      => '單集節目名稱為必填',
            'sub_title.required'  => '單集簡介為必填',
            'sub_title.max'       => '單集簡介限制300字',
            'anchor.required'     => '主持人為必填',
            'anchor.max'          => '主持人限制15字',
            'url.required'        => '音檔位址為必填',
            'url.url'             => '音檔位址格式錯誤',
            'start_date.required' => '指定上架日期為必填',
            'start_date.date'     => '指定上架日期格式錯誤',
            'end_date.required'   => '指定下架日期為必填',
            'end_date.date'       => '指定上架日期格式錯誤',
        ];
        $this->validate($request, [
            'categories' => 'required',
            'title'      => 'required|max:30',
            'sub_title'  => 'required|max:300',
            'anchor'     => 'required|max:15',
            'url'        => 'required|url',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ], $message);

        $this->programService->programStore($request);

        return response()->json(['message' => '新增成功']);
    }

    public function edit(EditRequest $request, $id)
    {
        $categories = Category::all();
        $program    = $this->programService->programFind($id);

        return response()->json([
            'categories' => $categories,
            'program'    => $program,
        ]);

    }

    public function update(UpdateRequest $request, $id)
    {
        $message = [
            'categories.required' => '節目名稱為必填',
            'title.max'           => '單集節目名稱限制30字',
            'title.required'      => '單集節目名稱為必填',
            'sub_title.required'  => '單集簡介為必填',
            'sub_title.max'       => '單集簡介限制300字',
            'anchor.required'     => '主持人為必填',
            'anchor.max'          => '主持人限制15字',
            'url.required'        => '音檔位址為必填',
            'url.url'             => '音檔位址格式錯誤',
            'start_date.required' => '指定上架日期為必填',
            'start_date.date'     => '指定上架日期格式錯誤',
            'end_date.required'   => '指定下架日期為必填',
            'end_date.date'       => '指定上架日期格式錯誤',
        ];
        $this->validate($request, [
            'categories' => 'required',
            'title'      => 'required|max:30',
            'sub_title'  => 'required|max:300',
            'anchor'     => 'required|max:15',
            'url'        => 'required|url',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
        ], $message);
        $this->programService->programUpdate($id, $request);

        return response()->json(['message' => '編輯成功']);
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->programService->programDestroy($id);

        return response()->json(['message' => '刪除成功']);
    }

}

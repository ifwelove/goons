<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Push\UpdateRequest;
use App\Http\Requests\Push\DestoryRequest;
use App\Http\Requests\Push\EditRequest;
use App\Models\BibleCategory;
use App\Models\BibleNewCategory;
use App\Models\BibleNewProgram;
use App\Models\BibleProgram;
use App\Models\Category;
use App\Models\News;
use App\Models\Program;
use App\Services\PushService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PushController extends Controller
{
    private $pushService;

    //@todo cron job 推播

    public function __construct(PushService $pushService)
    {
        $this->pushService = $pushService;
    }

    public function index(Request $request)
    {
        $perPage    = $request->get('perPage', null);
        $status     = $request->get('status', null);
        $keyword    = $request->get('keyword', null);
        $start_date = $request->get('start_date', null);
        $pushs      = $this->pushService->pushPaginate($perPage, $keyword, $status, $start_date);
        $pushs->appends($request->query())
            ->links();
        $result           = [];
        $result['status'] = [
            '預約中',
            '已發佈',
        ];
        $result['pushs']  = $pushs;

        return response()->json($result);
    }

    public function store(StoreRequest $request)
    {
        $message = [
            'title.max'          => '標題限制20字',
            'title.required'     => '標題為必填',
            'sub_title.max'      => '推播內容限制100字',
            'sub_title.required' => '推播內容為必填',
            'url.required'       => '跳轉位址為必填',
            'status.required'    => '推播時間為必填',
            //            'start_date.required' => '指定上架日期為必填',
            //            'start_date.date'     => '指定上架日期格式錯誤',
        ];
        $this->validate($request, [
            'title'      => 'required|max:20',
            'sub_title'  => 'required|max:100',
            'status'     => 'required',
            'url'        => 'required',
            'start_date' => 'required|date',
        ], $message);

        $this->pushService->pushStore($request);

        return response()->json(['message' => '新增成功']);
    }

    public function edit(EditRequest $request, $id)
    {
        $news          = News::select('title', 'id')
            ->where('start_date', '<=', Carbon::now())
            ->where('end_date', '>=', Carbon::now())
            ->get();
        $categories    = Category::select('title', 'id')
            ->where('status', 1)
            ->get();
        $oldCategories = BibleCategory::select('title', 'id')
            ->get();
        $newCategories = BibleNewCategory::select('title', 'id')
            ->get();
        $push          = $this->pushService->pushFind($id);

        return response()->json([
            'first'  => ['音頻', '最新消息', '聯絡我們', '首頁'],
            'second' => [
                ['新約', '舊約', '節目'],
                $news
            ],
            'third'  => [
                $newCategories,
                $oldCategories,
                $categories
            ],
            'push'   => $push,
        ]);

    }

    public function update(UpdateRequest $request, $id)
    {
        $message = [
            'title.max'          => '標題限制20字',
            'title.required'     => '標題為必填',
            'sub_title.max'      => '推播內容限制100字',
            'sub_title.required' => '推播內容為必填',
            'status.required'    => '推播時間為必填',
            'url.required'       => '跳轉位址為必填',
            //            'start_date.required' => '指定上架日期為必填',
            //            'start_date.date'     => '指定上架日期格式錯誤',
        ];
        $this->validate($request, [
            'title'      => 'required|max:20',
            'sub_title'  => 'required|max:100',
            'status'     => 'required',
            'url'     => 'required',
            'start_date' => 'required|date',
        ], $message);
        $this->pushService->pushUpdate($id, $request);

        return response()->json(['message' => '編輯成功']);
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->pushService->pushDestroy($id);

        return response()->json(['message' => '刪除成功']);
    }

}

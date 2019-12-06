<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\News\UpdateRequest;
use App\Http\Requests\News\DestoryRequest;
use App\Http\Requests\News\EditRequest;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    private $newsService;

    //@todo cron job 推播 fixed

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $perPage    = $request->get('perPage', null);
        $status     = $request->get('status', null);
        $title      = $request->get('title', null);
        $start_date = $request->get('start_date', null);
        $end_date = $request->get('end_date', null);
        $news       = $this->newsService->newsPaginate($perPage, $title, $status, $start_date, $end_date);
        $news->appends($request->query())
            ->links();
        $result           = [];
        $result['status'] = [
            '已下架',
            '已上架',
            '預約中',
        ];
        $result['news']   = $news;
        return response()->json($result);
    }

    public function store(StoreRequest $request)
    {
        $message = [
            'title.max'            => '標題限制50字',
            'title.required'       => '標題為必填',
            'description.required' => '消息內容為必填',
            'auto_push.required'   => '自動推播為必填',
            'start_date.required'  => '指定上架日期為必填',
            'start_date.date'      => '指定上架日期格式錯誤',
            'end_date.required'    => '指定下架日期為必填',
            'end_date.date'        => '指定上架日期格式錯誤',
        ];
        $this->validate($request, [
            'title'       => 'required|max:50',
            'description' => 'required',
            'auto_push'   => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date',
        ], $message);

        $this->newsService->newsStore($request);

        return response()->json(['message' => '新增成功']);
    }

    public function edit(EditRequest $request, $id)
    {
        $news = $this->newsService->newsFind($id);

        return response()->json([
            'news' => $news,
        ]);

    }

    public function update(UpdateRequest $request, $id)
    {
        $message = [
            'title.max'            => '標題限制50字',
            'title.required'       => '標題為必填',
            'description.required' => '消息內容為必填',
            'auto_push.required'   => '自動推播為必填',
            'start_date.required'  => '指定上架日期為必填',
            'start_date.date'      => '指定上架日期格式錯誤',
            'end_date.required'    => '指定下架日期為必填',
            'end_date.date'        => '指定上架日期格式錯誤',
        ];
        $this->validate($request, [
            'title'       => 'required|max:50',
            'description' => 'required',
            'auto_push'   => 'required',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date',
        ], $message);
        $this->newsService->newsUpdate($id, $request);

        return response()->json(['message' => '編輯成功']);
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->newsService->newsDestroy($id);

        return response()->json(['message' => '刪除成功']);
    }

    public function imageUpload(Request $request)
    {
        $message = [
            'uploaded' => '上傳失敗',
            'required' => '請上傳圖片檔案',
            'image'    => '請上傳圖片檔案',
            'mimes'    => '圖片檔案格式不允許',
            'max'      => '檔案大於2M',
        ];
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $message);
        if ($request->hasFile('image')) {
            $image           = $request->file('image');
            $name            = md5(time()) . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/news/');
            $path            = $request->file('image')
                ->storeAs('images/news', $name . '.' . $image->getClientOriginalExtension());
            $image->move($destinationPath, $name);
        }

        return response()->json([
            'message'   => '上傳成功',
            'imageUrl'  => url('images/news/' . $name),
            'imagePath' => 'images/news/' . $name
        ]);
    }

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Category\DestoryRequest;
use App\Http\Requests\Category\EditRequest;
use App\Http\Requests\Account\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $perPage    = $request->get('perPage', null);
        $keyword    = $request->get('keyword', null);
        $status     = $request->get('status', null);
        $categories = $this->categoryService->categoryPaginate($perPage, $keyword, $status);
        $categories->appends($request->query())
            ->links();

        return response()->json($categories);
    }

    public function store(StoreRequest $request)
    {
        $message = [
            'title.required'     => '節目名稱為必填',
            'title.max'          => '節目名稱限制10字',
            'sub_title.required' => '節目介紹為必填',
            'sub_title.max'      => '節目介紹限制20字',
            'anchor.required'    => '節目主持為必填',
            'anchor.max'         => '節目主持限制20字',
            'image.required'     => '請上傳圖片檔案',
        ];
        $this->validate($request, [
            'title'     => 'required|max:10',
            'sub_title' => 'required|max:500',
            'anchor'    => 'required|max:20',
            'image'     => 'required',
        ], $message);

        $this->categoryService->categoryStore($request);

        return response()->json(['message' => '新增成功']);
    }

    public function storeImage(StoreRequest $request)
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
            $name            = 'temp_category' . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/category/');
            $path            = $request->file('image')
                ->storeAs('images/category', 'temp_category' . '.' . $image->getClientOriginalExtension());
            $image->move($destinationPath, $name);
        }

        return response()->json([
            'message'   => '上傳成功',
            'imageUrl'  => url('images/category/' . $name),
            'imagePath' => 'images/category/' . $name
        ]);
    }

    public function edit(EditRequest $request, $id)
    {
        $category           = $this->categoryService->categoryFind($id);
        $category->imageUrl = url($category->image);

        return response()->json([
            'category' => $category,
        ]);

    }

    public function update(UpdateRequest $request, $id)
    {
        $message = [
            'title.required'     => '節目名稱為必填',
            'title.max'          => '節目名稱限制10字',
            'sub_title.required' => '節目介紹為必填',
            'sub_title.max'      => '節目介紹限制20字',
            'anchor.required'    => '節目主持為必填',
            'anchor.max'         => '節目主持限制20字',
            'image.required'     => '請上傳圖片檔案',
        ];
        $this->validate($request, [
            'title'     => 'required|max:10',
            'sub_title' => 'required|max:500',
            'anchor'    => 'required|max:20',
            'image'     => 'required',
        ], $message);

        $this->categoryService->categoryUpdate($id, $request);

        return response()->json(['message' => '編輯成功']);
    }

    public function destroy(DestoryRequest $request, $id)
    {
        $this->categoryService->categoryDestroy($id);

        return response()->json(['message' => '刪除成功']);
    }

    public function updateStatus(UpdateRequest $request, $id)
    {
        $this->categoryService->categoryStatusUpdate($id, $request);

        return response()->json(['message' => '更新成功']);
    }

    public function updateSort(UpdateRequest $request, $id, $type)
    {
        $this->categoryService->categorySortUpdate($id, $type);

        return response()->json(['message' => '更新成功']);
    }

}

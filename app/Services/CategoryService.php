<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{

    public function __construct()
    {
    }

    public function categoryPaginate($perPage = null, $keyword = null, $status = null)
    {
        if (is_null($perPage)) {
            $perPage = 10;
        }
        $query = Category::query();
        $query->when(! is_null($status), function ($q) use ($status) {
            return $q->where('status', $status);
        });
        $query->when(! is_null($keyword), function ($q) use ($keyword) {
            return $q->where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('anchor', 'LIKE', '%' . $keyword . '%');
        });
        $categories = $query->orderBy('sort', 'asc')
            ->paginate($perPage);

        return $categories;
    }

    public function categoryFind($id)
    {
        $category = Category::find($id);

        return $category;
    }

    public function categoryStore($request)
    {
        $contents        = Storage::get($request->get('image'));
        $basePath        = '/images/category/';
        $category        = Category::create($request->all());
        $imageInfo       = explode('.', $request->get('image'));
        $image           = $category->id . '.' . end($imageInfo);
        $destinationPath = public_path($basePath);
        $imageUrl        = $destinationPath . $image;
        file_put_contents($imageUrl, $contents);

        $category->image = $basePath . $image;
        $category->sort = 999;
        $category->save();

        return $category;
    }

    public function categoryDestroy($id)
    {
        $result = Category::destroy($id);
        $this->categoryResetSort();

        return $result;
    }

    public function categoryUpdate($id, $request)
    {
        $category = Category::find($id);
        if ($category->image == $request->get('image')) {
            //@沒改圖
            $category->title     = $request->get('title', null);
            $category->sub_title = $request->get('sub_title', null);
            $category->anchor    = $request->get('anchor', null);
            $category->save();
        } else {
            //@換圖片
            $basePath        = '/images/category/';
            $imageInfo       = explode('.', $request->get('image'));
            $image           = $category->id . '.' . end($imageInfo);
            $destinationPath = public_path($basePath);
            $imageUrl        = $destinationPath . $image;
            $contents        = Storage::get($request->get('image'));
            file_put_contents($imageUrl, $contents);

            $category->image = $basePath . $image;
            $category->save();
        }

        return $category;
    }

    public function categoryStatusUpdate($id, $request)
    {
        $inputs = [];
        $status = $request->get('status', null);
        if (! is_null($status)) {
            $inputs['status'] = $status;
        }
        if (! empty($inputs)) {
            $category = Category::find($id);
            $category->update($inputs);
        }

        return true;
    }

    public function categoryResetSort($id = null, $add = null)
    {
        if (!is_null($id) && !is_null($add)) {
            $categories = Category::where('sort', '>', 0)
                ->where('id', '!=', $id)
                ->orderBy('sort')
                ->get();
            $calc = 1 + $add;
        } else {
            $categories = Category::where('sort', '>', 0)
                ->orderBy('sort')
                ->get();
            $calc = 1;
        }
        foreach ($categories as $category) {
            $category->sort = $calc;
            $category->save();
            $calc++;
        }
    }

    public function categorySortUpdate($id, $type)
    {
        $category = Category::find($id);
        $sort     = $category->sort;

        switch ($type) {
            case 'add':
                if ($sort != 1) {
                    $categoryChange = Category::where('sort', '<', $sort)
                        ->latest('sort')
                        ->first();
                    if (! is_null($categoryChange)) {
                        $category->sort = $categoryChange->sort;
                        $category->save();

                        $categoryChange->sort = $sort;
                        $categoryChange->save();
                        $this->categoryResetSort();
                    }
                }
                break;
            case 'sub':
                $categoryChange = Category::where('sort', '>', $sort)
                    ->oldest('sort')
                    ->first();
                if (! is_null($categoryChange)) {
                    $category->sort = $categoryChange->sort;
                    $category->save();

                    $categoryChange->sort = $sort;
                    $categoryChange->save();
                    $this->categoryResetSort();
                }
                break;
            case 'top':
                $categoryChange = Category::where('sort', '<', $sort)
                    ->orderBy('sort', 'desc')
                    ->oldest('sort')
                    ->first();
                if (! is_null($categoryChange)) {
                    $category->sort = 1;
                    $category->save();
                    $this->categoryResetSort($category->id, 1);
                }
                break;
            case 'down':
                $categoryChange = Category::where('sort', '>', $sort)
                    ->orderBy('sort', 'desc')
                    ->oldest('sort')
                    ->first();
                if (! is_null($categoryChange)) {
                    $category->sort = $categoryChange->sort + 1;
                    $category->save();
                    $this->categoryResetSort();
                }
                break;
        }

        return true;
    }

}

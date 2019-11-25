<?php

namespace App\Services;

use App\Models\Program;

class ProgramService
{

    public function __construct()
    {
    }

    public function programPaginate($perPage = null, $category = null)
    {
        if (is_null($perPage)) {
            $perPage = 10;
        }
        $query = Program::query();
        $query->when(! is_null($category), function ($q) use ($category) {
            return $q->where('categories', $category);
        });
        $programs = $query->orderBy('id', 'desc')
            ->paginate($perPage);

        return $programs;
    }

    public function programFind($id)
    {
        $category = Program::find($id);

        return $category;
    }

    public function programStore($request)
    {
        $program = Program::create($request->all());

        return $program;
    }

    public function programDestroy($id)
    {
        $result = Program::destroy($id);

        return $result;
    }

    public function programUpdate($id, $request)
    {
        $program = Program::findOrFail($id);
        $program->update($request->all());

        return true;
    }

    //    public function categoryStatusUpdate($id, $request)
    //    {
    //        $inputs = [];
    //        $status = $request->get('status', null);
    //        if (! is_null($status)) {
    //            $inputs['status'] = $status;
    //        }
    //        if (! empty($inputs)) {
    //            $category = Category::find($id);
    //            $category->update($inputs);
    //        }
    //
    //        return true;
    //    }
    //
    //    public function categoryResetSort($id = null, $add = null)
    //    {
    //        if (!is_null($id) && !is_null($add)) {
    //            $categories = Category::where('sort', '>', 0)
    //                ->where('id', '!=', $id)
    //                ->orderBy('sort')
    //                ->get();
    //            $calc = 1 + $add;
    //        } else {
    //            $categories = Category::where('sort', '>', 0)
    //                ->orderBy('sort')
    //                ->get();
    //            $calc = 1;
    //        }
    //        foreach ($categories as $category) {
    //            $category->sort = $calc;
    //            $category->save();
    //            $calc++;
    //        }
    //    }
    //
    //    public function categorySortUpdate($id, $type)
    //    {
    //        $category = Category::find($id);
    //        $sort     = $category->sort;
    //
    //        switch ($type) {
    //            case 'add':
    //                if ($sort != 1) {
    //                    $categoryChange = Category::where('sort', '<', $sort)
    //                        ->latest('sort')
    //                        ->first();
    //                    if (! is_null($categoryChange)) {
    //                        $category->sort = $categoryChange->sort;
    //                        $category->save();
    //
    //                        $categoryChange->sort = $sort;
    //                        $categoryChange->save();
    //                        $this->categoryResetSort();
    //                    }
    //                }
    //                break;
    //            case 'sub':
    //                $categoryChange = Category::where('sort', '>', $sort)
    //                    ->oldest('sort')
    //                    ->first();
    //                if (! is_null($categoryChange)) {
    //                    $category->sort = $categoryChange->sort;
    //                    $category->save();
    //
    //                    $categoryChange->sort = $sort;
    //                    $categoryChange->save();
    //                    $this->categoryResetSort();
    //                }
    //                break;
    //            case 'top':
    //                $categoryChange = Category::where('sort', '<', $sort)
    //                    ->orderBy('sort', 'desc')
    //                    ->oldest('sort')
    //                    ->first();
    //                if (! is_null($categoryChange)) {
    //                    $category->sort = 1;
    //                    $category->save();
    //                    $this->categoryResetSort($category->id, 1);
    //                }
    //                break;
    //            case 'down':
    //                $categoryChange = Category::where('sort', '>', $sort)
    //                    ->orderBy('sort', 'desc')
    //                    ->oldest('sort')
    //                    ->first();
    //                if (! is_null($categoryChange)) {
    //                    $category->sort = $categoryChange->sort + 1;
    //                    $category->save();
    //                    $this->categoryResetSort();
    //                }
    //                break;
    //        }
    //
    //        return true;
    //    }

}

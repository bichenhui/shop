<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Good;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{

    public function index()
    {
        return view ('admin.good.index');
    }

    public function create(Category $category)
    {//获取所有数据
//        dd (Category::all ()->toArray ());
        $categories=$category->getTreeData (Category::all ()->toArray ());
        return view ('admin.good.create',compact ('categories'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Good $good)
    {
        //
    }

    public function edit(Good $good)
    {
        //
    }

    public function update(Request $request, Good $good)
    {
        //
    }

    public function destroy(Good $good)
    {
        //
    }
}

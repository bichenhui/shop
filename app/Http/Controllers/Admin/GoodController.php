<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GoodRequest;
use App\Models\Category;
use App\Models\Good;
use App\Models\Spec;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodController extends Controller
{

    public function index(Good $good)
    {
//        dd ($good->all());
        $goods=$good->latest()->paginate(10);
        return view ('admin.good.index',compact ('goods'));
    }

    public function create(Category $category)
    {//获取所有数据
//        dd (Category::all ()->toArray ());
        $categories=$category->getTreeData (Category::all ()->toArray ());
        return view ('admin.good.create',compact ('categories'));
    }

    public function store(GoodRequest $request,Good $good)
    {
//        dd ($request->all ());
        //添加商品
        $data=$request->all ();
//        dd ($data);
        $data['admin_id']=auth ('admin')->id();
        $specs=json_decode ($data['specs'],true);
//        dd($specs);
        //计算商品总数量
        $total=0;
        foreach ($specs as $v){
            $total +=$v['total'];
        }
        $data['total']=$total;
//        dd ($total);
        //执行完成 create 之后,返回当前添加数据对象
        $good=$good->create($data);
//        dd ($good);
        //添加商品详情
        foreach ($specs as $v){
            $spec=new Spec();
            $spec->spec=$v['spec'];
            $spec->total=$v['total'];
            $spec->good_id=$good->id;
            $spec->save();
        }
        return redirect ()->route ('admin.good.index')->with ('success','添加成功');
    }
    public function edit(Good $good,Category $category)
    {
//        dd ($category->all());
        $categories=$category->getEditCategorys ( $good['id']);

        $specs=json_encode (Spec::where('good_id',$good->id)->get());

//        dd ($specs);
        return view ('admin.good.edit',compact ('good','categories','specs'));
    }

    public function update(GoodRequest $request, Good $good)
    {
//        dd ($request->all ());
        //添加商品
        $data=$request->all ();
//        dd ($data);
        $data['admin_id']=auth ('admin')->id();
        $specs=json_decode ($data['specs'],true);
//        dd($specs);
        //计算商品总数量
        $total=0;
        foreach ($specs as $v){
            $total +=$v['total'];
        }
        $data['total']=$total;
//        dd ($total);
        //执行完成 create 之后,返回当前添加数据对象
        $good->update($data);
//        dd ($good);
        //添加商品详情
        foreach ($specs as $v) {
            $spec = new Spec();
            $spec->spec = $v['spec'];
            $spec->total = $v['total'];
            $spec->good_id = $good->id;
            $spec->save ();
            return redirect ()->route ('admin.good.index')->with ('success','编辑成功');
        }
    }

    public function destroy(Good $good)
    {
        $good->delete ();
        return back ()->with ('success','删除成功');
    }
}

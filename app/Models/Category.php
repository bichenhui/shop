<?php

namespace App\Models;

use Houdunwang\Arr\Arr;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
//      获得树状结构
    public function getTreeData($data){

        return (new Arr())->tree ($data,'name','id','pid');
    }
//获取编辑时候的所有栏目数据,不包含自己和自己的子集
    public function getEditCategorys($id){
        //首先获取所有栏目数据
        $categories=static::all ();
        //获取当前$id 子集数据
        $ids = $this->getSon( $categories , $id );
//        dd($ids);
        //把子集追加进去
        $ids[]=$id;
        //将$ids 数据筛出去
        $data=$this->whereNotIn('id',$ids)->get();
//        dd ($data);
        //转为树状结构
        return $this->getTreeData( $data->toArray() );
    }
    /**
     * 递归找子集
     *
     * @param $data  数组数据
     * @param $id    找谁的子集(id)
     *
     * @return array
     */
    public function getSon($data , $id){
//        dd($data->toArray());
        static $temp = [];
        foreach ($data as $v){
            if ($id==$v['pid']){
                $temp []=$v['id'];
                $this->getSon ($data,$v['id']);
            }
        }
        return $temp;
    }
}

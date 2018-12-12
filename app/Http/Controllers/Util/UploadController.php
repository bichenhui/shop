<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function upload (Request $request)
    {
//        dd ($_FILES);
        //必须打印所有 request 请求的数据,需要知道上传文件 name
        //dd($request->all());
        //$request->file('上传文件表单 name')
        $file = $request->file ('file');
        $this->checkType ($file);
        $this->checkSize ($file);
        if ($file) {
            //$path = $file->store('上传文件存储目录','磁盘:filesystems 文件里面看disks');
            //上传需要 php 扩展:fileinfo
            $path = $file->store ('upload', 'upload');
//            dd($path);
            return [
                "code"=> 0,
                "mag"=>'',
                "data"=>[
                    "src"=>'/'.$path
                ],
            ];
        }
    }
    //验证上传大小
    public function checkSize($file){
        //$file->getSize()获取上传文件大小
        if ($file->getSize()>200){
            throw new UploadException('上传文件过大');
        }
    }
    //验证上传类型
    public function checkType($file){
        if(!in_array ( strtolower ($file->getClientOriginalExtension()),['jpg','png'])){
            throw new UploadException('类型不允许');
        }
    }
}

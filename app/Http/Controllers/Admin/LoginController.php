<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{//加载登录页面
    public function index(){
        return view ('admin.login.index');
    }
    //登录提交
    public function login(LoginRequest $request){
        //首先创建LoginRequest 验证规则写进去 接下来按步骤做
        //1.自定义守卫 config/auth.php  [guards , providers]
        //2.Admin 模型需要继承Authenticatable类,参考默认 User 模型
        //3.必须制定看守器
        if (\Auth::guard ('admin')->attempt (['username'=>$request->username,'password'=>$request->password],$request->remember)){
//            dd('登录成功');
            return redirect ()->route ('admin.index')->with ('success','登录成功');
        }
        return redirect ()->back ()->with ('danger','用户名和密码不正确');
    }
    public function logout(){
        \Auth::guard ('admin')->logout ();
        return redirect ()->route ('admin.login');
    }
}

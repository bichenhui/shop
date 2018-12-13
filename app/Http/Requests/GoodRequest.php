<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth ('admin')->check ();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'content'=>'required',
            'price'=>'required| numeric|min:1'
        ];
    }
    public function messages ()
    {
       return [
           'title.required'=>'请输入商品名称',
           'content.required'=>'请输入商品详情',
           'price.required'=>'请输入商品价格',
           'price.numeric'=>'请输入价格不能为负',
           'price.min'=>'不能小于1',
       ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    protected $fillable = ['title' , 'price' , 'description' , 'content' , 'list_pic' , 'pics' , 'category_id','admin_id','total'];
    protected $casts = [
        'pics' => 'array'
    ];
    public function category(){
        return $this->belongsTo (Category::class);
    }
}

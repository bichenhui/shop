<?php

namespace App\Exceptions;

use Exception;

class UploadException extends Exception
{
    public function render(){
        return response ()->json (['message'=>$this->getMessage (),'code'=>403],200);
    }
}

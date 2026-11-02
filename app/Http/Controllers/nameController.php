<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class nameController extends Controller implements HasMiddleware
{
     public static function middleware(): array
    {
        return [
            'name',
        ];
    }
    public function nameNum(Request $request){
        $num = $request->num;
        $user = $request -> input('user');
        if($num == 1){
        return "laravel" .$user;
    }elseif($num==2){
        return "php" .$user;

    }

    }
}

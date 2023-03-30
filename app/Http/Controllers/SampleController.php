<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SampleController extends Controller
{
    public function home(){
        return view('welcome');
    }

    public function about($name, $email){
        return view('about', ['myname'=>$name, 'myemail'=>$email]);
    }

    public function service(){
        $arr = ['Sports', 'Politics', 'Business', 'Music'];
        return view('service', ['services'=>$arr]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayoutController extends Controller
{
    public function dashboard(){
        return view('admin.pages.dashboard');
    }
    public function formElements(){
        return view('admin.pages.form_elements');
    }
    
    public function home(){
        return view('website.pages.home');
    }
    public function about(){
        return view('website.pages.about');
    }
}

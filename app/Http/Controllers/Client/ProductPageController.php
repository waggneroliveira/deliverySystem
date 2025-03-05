<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index(){
        return view('client.blades.products');
    }


    public function products($category = null){
        // dd($category);
        return view('client.blades.products', compact('category'));
    }
}

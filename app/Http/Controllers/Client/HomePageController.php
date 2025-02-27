<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        return view('client.blades.app');
    }

    public function slides(){
        $slides = Slide::active()->sorting()->get();

        return response()->json($slides);
    }
}

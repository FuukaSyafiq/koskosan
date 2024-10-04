<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function gets()
    {
        $datas = [

        ];

        return view('index', ['user' => auth()->user(), 'data' => $datas]);
    }
}

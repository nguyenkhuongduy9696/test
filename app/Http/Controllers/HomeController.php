<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->id;
        $data = [];
        $data['pro'] = 3;
        $data['id'] = $id;
        return view('home', $data);
    }
}

<?php
namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return \View::make('index')->with('data', $data);
    }

}
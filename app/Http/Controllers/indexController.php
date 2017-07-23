<?php

namespace App\Http\Controllers;
use DB;
use App\Inventory;
use App\GetProductInfo;
use Illuminate\Http\Request;

class indexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        //dd($results);
        return view('index');
    }

}

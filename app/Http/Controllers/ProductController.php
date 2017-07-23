<?php

namespace App\Http\Controllers;
use DB;
use App\Product;

class ProductController extends Controller
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
        //$results = DB::select("SELECT * FROM products");
        $results=Product::all();
        //dd($results);
        return view('products',['test'=> $results]);
        echo "hello";
        //
    }

    //
}

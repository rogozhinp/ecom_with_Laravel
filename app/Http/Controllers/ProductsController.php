<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    //

    public function index()
    {
               /*$products = [0=>["name"=>"Iphone", "category"=>"smart phones", "price" => 1000],
                1 =>["name"=>"Galaxy", "category"=>"tablets", "price" => 2000],
                2 =>["name" =>"Sony", "category"=>"TV", "price"=>3000]];*/

               $products = DB::table('products')->get();

               return view("allproducts", compact("products"));

    }
}

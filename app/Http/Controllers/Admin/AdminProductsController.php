<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminProductsController extends Controller
{
    // display all products
    public function index(){
        $products = Product::all();
        return view("admin.displayProducts", ['products' => $products]);
    }

    // display edit product form
    public function editProductForm($id)
    {
        $product = Product::find($id);
        return view('admin.editProductForm', ['product'=>$product]);
    }

    // display edit product image form
    public function editProductImageForm($id)
    {
        $product = Product::find($id);
        return view('admin.editProductImageForm', ['product'=>$product]);
    }

    // update product image
    public function updateProductImage(Request $request, $id)
    {
        Validator::make($request->all(), ['image'=>"required|image|mimes:jpg,png,jpeg|max:10000"])->validate();

        if($request->hasFile("image")){
            $product = Product::find($id);
            $exists = Storage::disk('local')->exists("public/product_images/".$product->image);
            // delete old image
            if($exists){
                Storage::delete('public/product_images/'.$product->image);
            }

            // upload new image
            $ext = $request->file('image')->getClientOriginalExtension();
            $request->image->storeAs("public/product_images/", $product->image);

            $arrayToUpdate = array('image'=>$product->image);
            DB::table('products')->where('id', $id)->update($arrayToUpdate);

            return redirect()->route("adminDisplayProducts");
        }else{
            return "No image was selected";
            return $error;
        }
    }
}

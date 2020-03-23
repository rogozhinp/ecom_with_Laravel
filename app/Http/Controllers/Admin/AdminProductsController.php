<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class AdminProductsController extends Controller
{
    // display all products
    public function index(){
        $products = Product::paginate(3);
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

    public function updateProduct(Request $request, $id){
        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $price = $request->input('price');

        $arrayToUpdate = array("name" =>$name, "description"=>$description, "type"=>$type, "price"=>$price);

        DB::table('products')->where('id', $id)->update($arrayToUpdate);

        return redirect()->route("adminDisplayProducts");
    }

    public function createProductForm(){

        return view("admin.createProductForm");
    }

    // create new Product - action on submit
    public function sendCreateProductForm(Request $request){
        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $price = $request->input('price');
        Validator::make($request->all(), ['image'=>"required|image|mimes:jpg,png,jpeg|max:10000"])->validate();
        $ext = $request->file('image')->getClientOriginalExtension();
        $stringImageReFormat = str_replace(" ", "", $request->input('name'));

        $imageName = $stringImageReFormat.".".$ext;


        $imageEncoded = File::get($request->image);
        Storage::disk("local")->put(('product_images/').$imageName, $imageEncoded);

        $newProductArray = array("name"=>$name, "description"=>$description, "image"=>$imageName, "type"=>$type, "price"=>$price);
        $created = DB::table('products')->insert($newProductArray);

        if ($created) {
            return redirect()->route("adminDisplayProducts");
        }else{
            return "Product was not created";
        }
    }

    public function deleteProduct($id) {
        $product = Product::find($id);
        $exists = Storage::disk('local')->exists("public/product_images/".$product->image);

        // delete old image
        if($exists){
            Storage::delete('public/product_images/'.$product->image);
        }

        Product::destroy($id);

        return redirect()->route("adminDisplayProducts");
    }
}

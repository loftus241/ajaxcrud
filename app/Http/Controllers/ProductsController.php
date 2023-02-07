<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products(){
        $products=Product::latest()->paginate(5);
        return view('products',compact('products'));
    }

    // store
    public function addproducts(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:Products',
            'price'=>'required',
        ],
        [
            'name.required'=>'Name is required',
            'name.unique'=>'Products exist',
            'price.required'=>'Price is required',
        ]);

        $product = new Product;
        $product->name= $request->name;
        $product->price= $request->price;
        $product->save();
        return response()->json([
            'statut'=>'success',
        ]);
    }

    //update
    public function updateproducts(Request $request)
    {
        $request->validate([
            'up_name'=>'required|unique:products,name,'.$request->up_id,
            'up_price'=>'required',
        ],
        [
            'up_name.required'=>'Name is required',
            // 'up_price.unique'=>'Products exist',
            'up_price.required'=>'Price is required',
        ]); 
        Product::where('id',$request->up_id)->update([
            'name'=>$request->up_name,
            'price'=>$request->up_price,
        ]);
        return response()->json([
            'statut'=>'success',
        ]);
    }

    public function deleteproducts(Request $request){
        Product::find($request->product_id)->delete();
        return response()->json([
            'statut'=>'success',
        ]);
    }

    public function pagination(){
        $products=Product::latest()->paginate(5);
        return view('paginations_products',compact('products'))->render();
    }

    public function searchproducts(Request $request){
        $products=Product::where('name','like','%'.$request->search_string.'%')
        ->orWhere('price','like','%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(5);

        if($products->count() >=1){
            return view('paginations_products',compact('products'))->render();
        }
        else{
            return response()->json([
                'statut'=>'nothing_found',
            ]);
        }
    }
}
